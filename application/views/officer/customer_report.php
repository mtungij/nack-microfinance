<?php include('incs/header_1.php'); ?>
<?php include('incs/side_1.php'); ?>
<?php include('incs/subheader.php'); ?>

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">					
    <div class="kt-subheader kt-grid__item" id="kt_subheader"></div>

    <?php if (@$customer->f_name == TRUE) { ?>
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        
        <?php if ($das = $this->session->flashdata('massage')): ?>
            <div class="alert alert-success fade show" role="alert">
                <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                <div class="alert-text"><?php echo $das; ?></div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__media">
                                    <?php if ($customer->passport == TRUE) { ?>
                                        <img src="<?php echo base_url().'assets/img/'.$customer->passport; ?>" alt="passport" style="width: 220px; height: 180px;">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>assets/img/user.png" alt="passport" style="width: 220px; height: 180px;">
                                    <?php } ?>
                                </div>

                                <style>.c { text-transform: uppercase; }</style>

                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="javascript:;" class="kt-widget__username">
                                            <b class="c">
                                                <?php echo $customer->f_name; ?> 
                                                <?php echo $customer->m_name; ?> 
                                                <?php echo $customer->l_name; ?>
                                            </b>
                                        </a>
                                        <div class="kt-widget__action">
                                            <?php if ($customer->signature == TRUE) { ?>
                                                <img src="<?php echo base_url().'assets/img/'.$customer->signature; ?>" alt="Signature" style="width: 300px; height: 180px;">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/img/sig.jpg" alt="Signature" style="width: 300px; height: 180px;">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <?php
                $loan = $customer_report[0];

                $startDate = new DateTime($loan->loan_stat_date);
                $startDate->modify('+1 day');

                if ($loan->day == 1) {
                    $intervalSpec = 'P1D';
                } elseif ($loan->day == 7) {
                    $intervalSpec = 'P1W';
                } elseif ($loan->day == 30 || $loan->day == 31) {
                    $intervalSpec = 'P1M';
                } else {
                    $intervalSpec = 'P1D';
                }

                $interval = new DateInterval($intervalSpec);

                $dates = [];
                $currentDate = clone $startDate;
                for ($i = 0; $i < $loan->session; $i++) {
                    $dates[] = clone $currentDate;
                    $currentDate->add($interval);
                }

                $payments = [];
                foreach ($customer_report as $r) {
                    if (!empty($r->depost_day)) {
                        $payDate = date('Y-m-d', strtotime($r->depost_day));
                        $payments[$payDate] = $r->depost;
                    }
                }

                $balance = $loan->loan_int;
                $i = 1;
                $prepaid = 0; // Malipo ya ziada ya siku za mbele
                ?>

                <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr style="background-color: #2c77f4;color:white;">
                            <th>#</th>
                            <th>Tarehe</th>
                            <th>Rejesho</th>
                            <th>Lipwa</th>
                            <th>Faini</th>
                            <th>Salio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dates as $date): 
                            $d = $date->format('Y-m-d');
                            $paidToday = $payments[$d] ?? 0;

                            $paidTotal = $paidToday + $prepaid;
                            $fine = 0;

                            if ($paidTotal >= $loan->restration) {
                                // Hakuna faini, weka prepaid kwa siku zijazo
                                $numFullPayments = floor($paidTotal / $loan->restration);
                                $remainder = $paidTotal % $loan->restration;

                                $paidDisplay = [];

                                for ($j = 0; $j < $numFullPayments; $j++) {
                                    $paidDisplay[] = $loan->restration;
                                }

                                if ($remainder > 0) {
                                    $paidDisplay[] = $remainder;
                                    $fine = $loan->penart_amount / 2; // nusu faini kwa partial
                                }

                                // Tumia kwanza kwa siku hii
                                $paidShown = array_shift($paidDisplay);
                                $prepaid = array_sum($paidDisplay);
                            } else {
                                // Partial payment au zero
                                $paidShown = $paidTotal;
                                if ($paidTotal == 0) {
                                    $fine = $loan->penart_amount;
                                } else {
                                    $fine = $loan->penart_amount / 2;
                                }
                                $prepaid = 0;
                            }

                            $balance -= min($paidTotal, $loan->restration);
                        ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $date->format('d-m-Y'); ?></td>
                            <td><?= number_format($loan->restration); ?></td>
                            <td><?= number_format($paidShown); ?></td>
                            <td><?= number_format($fine); ?></td>
                            <td><?= number_format($balance); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php include('incs/footer_1.php') ?>
