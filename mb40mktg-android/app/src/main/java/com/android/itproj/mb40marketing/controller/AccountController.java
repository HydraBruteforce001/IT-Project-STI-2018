package com.android.itproj.mb40marketing.controller;

import android.content.Context;

import com.android.itproj.mb40marketing.CoreApp;
import com.android.itproj.mb40marketing.helper.interfaces.AccountCallback;
import com.android.itproj.mb40marketing.model.AccountModel;
import com.android.itproj.mb40marketing.model.LoanModel;
import com.android.itproj.mb40marketing.model.ProfileModel;

import java.util.List;

import rx.Observer;
import rx.subscriptions.CompositeSubscription;

public class AccountController {

    private CompositeSubscription compositeSubscription;
    private Context context;

    private AccountModel accountModel;

    public AccountController(Context context) {
        this.context = context;
        this.compositeSubscription = new CompositeSubscription();
    }

    public void createAccount(final ProfileModel model, final AccountCallback callback) {
        compositeSubscription.add(
                ((CoreApp) context)
                        .getRestAPI()
                        .createAccount(new AccountModel(model.getUser_id()))
                        .subscribe(new Observer<AccountModel>() {
                            @Override
                            public void onCompleted() {

                            }

                            @Override
                            public void onError(Throwable e) {
                                callback.onError(e);
                            }

                            @Override
                            public void onNext(AccountModel accountModel) {
                                callback.onAccountRequest(accountModel);
                            }
                        })
        );
    }

    public void getAccountDetail(final ProfileModel model, final AccountCallback callback) {
        compositeSubscription.add(
                ((CoreApp) context)
                        .getRestAPI()
                        .getAccount(model.getId())
                        .subscribe(new Observer<AccountModel>() {
                            @Override
                            public void onCompleted() {

                            }

                            @Override
                            public void onError(Throwable e) {
                                callback.onError(e);
                            }

                            @Override
                            public void onNext(AccountModel accountModel) {
                                callback.onAccountRequest(accountModel);
                            }
                        })
        );
    }

    public void getLoans(int accountId, final AccountCallback callback) {
        compositeSubscription.add(
                ((CoreApp) context)
                        .getRestAPI()
                        .getLoanList(accountId)
                        .subscribe(new Observer<List<LoanModel>>() {
                            @Override
                            public void onCompleted() {

                            }

                            @Override
                            public void onError(Throwable e) {
                                callback.onError(e);
                            }

                            @Override
                            public void onNext(List<LoanModel> loanModelList) {
                                callback.onLoanListRequest(loanModelList);
                            }
                        }));
    }
}