﻿using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    public partial class Login : Form
    {
        public Login()
        {
            InitializeComponent();
        }
        
        private void login_btn_Click(object sender, EventArgs e)
        {
            this.Hide();
            var dashboard = new MainForm();
            dashboard.Closed += (s, args) => this.Close();
            dashboard.Show();
        }

        private void Login_Load(object sender, EventArgs e)
        {

        }
    }
}
