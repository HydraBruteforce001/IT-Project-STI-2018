﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WindowsFormsApp1
{
    class Transaction
    {
        public int it { get; set; }
        public int profile_id { get; set; }
        public int loan_id { get; set; }
        public int collector_id { get; set; }
        public double payment { get; set; }
        public double running_balance { get; set; }
        public double loan_value { get; set; }
        public string first_name { get; set; }
        public string middle_name { get; set; }
        public string last_name { get; set; }
    }
}
