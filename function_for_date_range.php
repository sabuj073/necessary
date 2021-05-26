public function getDateReport($search_type) {
        $first_date = '';
        $last_date='';
        if ($search_type == 'period') {

          $from_date = $this->input->post('date_from');
          $to_date = $this->input->post('date_to');

            $first_date = date("Y-m-d", $this->customlib->datetostrtotime($from_date));
            $last_date = date("Y-m-d", $this->customlib->datetostrtotime($to_date));

        } else if ($search_type == 'today') {

            $last_date = strtotime('today 00:00:00');

            $first_date = date('Y-m-d', $last_date);
            $last_date = $first_date;

        } else if ($search_type == 'this_week') {

            $this_week_start = strtotime('-1 week monday 00:00:00');
            $this_week_end = strtotime('sunday 23:59:59');

            $first_date = date('Y-m-d', $this_week_start);
            $last_date = date('Y-m-d', $this_week_end);

        } else if ($search_type == 'last_week') {

            $last_week_start = strtotime('-2 week monday 00:00:00');
            $last_week_end = strtotime('-1 week sunday 23:59:59');

            $first_date = date('Y-m-d', $last_week_start);
            $last_date = date('Y-m-d', $last_week_end);

        } else if ($search_type == 'this_month') {
            $first_date = date('Y-m-01');
            $last_date = date('Y-m-t');
        } else if ($search_type == 'last_month') {
            $month = date("m", strtotime("-1 month"));
            $first_date = date('Y-' . $month . '-01');
            $last_date = date('Y-' . $month . '-' . date('t', strtotime($first_date)));

        } else if ($search_type == 'last_3_month') {
            $month = date("m", strtotime("-2 month"));
            $first_date = date('Y-' . $month . '-01');
            $firstday = date('Y-' . 'm' . '-01');
            $last_date = date('Y-' . 'm' . '-' . date('t', strtotime($firstday)));

        } else if ($search_type == 'last_6_month') {
            $month = date("m", strtotime("-5 month"));
            $first_date = date('Y-' . $month . '-01');
            $firstday = date('Y-' . 'm' . '-01');
            $last_date = date('Y-' . 'm' . '-' . date('t', strtotime($firstday)));

        } else if ($search_type == 'last_12_month') {
            $first_date = date('Y-m' . '-01', strtotime("-11 month"));
            $firstday = date('Y-' . 'm' . '-01');
            $last_date = date('Y-' . 'm' . '-' . date('t', strtotime($firstday)));

        } else if ($search_type == 'last_year') {
            $search_year = date('Y', strtotime("-1 year"));
            $first_date = $search_year."-01-01";
            $last_date = $search_year."-12-31";

        } else if ($search_type == 'this_year') {

            $search_year = date('Y');
            $first_date = $search_year."-01-01";
            $last_date = $search_year."-12-31";

        }

        if($search_type!=null){
            if($search_type!=""){
                return $this->referral_model->getListFilter($first_date,$last_date);
            }else{
                return $this->referral_model->getList();
            }
        }else{
            return $this->referral_model->getList();
        }

    }