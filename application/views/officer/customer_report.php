<?php include('incs/header_1.php'); ?>
<?php include('incs/side_1.php'); ?>
<?php include('incs/subheader.php'); ?>

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">					
    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader"></div>
    <!-- end:: Subheader -->										

    <?php if (@$customer->f_name == TRUE) { ?>
    <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
        <!-- Flash message -->
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
                <!--begin:: Widgets/Applications/User/Profile3-->
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
                                </div> <!-- end content -->
                            </div> <!-- end top -->
                        </div> <!-- end widget -->
                    </div> <!-- end portlet body -->
                </div> <!-- end portlet -->
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <?php
                // Chukua mkopo mmoja
                $loan = $customer_report[0];

                // Tarehe ya kuanzia (loan_stat_date + 1 day)
                $startDate = new DateTime($loan->loan_stat_date);
                $startDate->modify('+1 day');

                // Aina ya interval kulingana na day
                if ($loan->day == 1) {
                    $intervalSpec = 'P1D'; // kila siku
                } elseif ($loan->day == 7) {
                    $intervalSpec = 'P1W'; // kila wiki
                } elseif ($loan->day == 30 || $loan->day == 31) {
                    $intervalSpec = 'P1M'; // kila mwezi
                } else {
                    $intervalSpec = 'P1D'; // default kila siku
                }

                $interval = new DateInterval($intervalSpec);

                // Tengeneza ratiba ya tarehe kulingana na session
                $dates = [];
                $currentDate = clone $startDate;
                for ($i = 0; $i < $loan->session; $i++) {
                    $dates[] = clone $currentDate;
                    $currentDate->add($interval);
                }

                // Weka malipo yaliyofanyika
                $payments = [];
                foreach ($customer_report as $r) {
                    if (!empty($r->depost_day)) {
                        $payDate = date('Y-m-d', strtotime($r->depost_day));
                        $payments[$payDate] = $r->depost;
                    }
                }

                // Salio la mkopo
                $balance = $loan->loan_int;
                $i = 1;
                ?>

                <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr style="background-color: #2c77f4;color:white;">
                            <th>Idadi ya marejesho</th>
                            <th>Tarehe</th>
                            <th>Rejesho</th>
                            <th>Lipwa</th>
                            <th>Faini</th>
                            <th>Salio La Mkopo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dates as $date): 
                            $d = $date->format('Y-m-d');
                            $paid = $payments[$d] ?? 0;
                            $balance -= $paid;
                        ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $date->format('d-m-Y'); ?></td>
                            <td><?= $loan->restration?></td>
                            <td><?= number_format($paid); ?></td>
                            <td><?= !empty($loan->penart_amount) ? number_format($loan->penart_amount) : 0; ?></td>
                            <td><?= number_format($balance); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div> <!-- end kt-content -->
    <?php } // end if customer->f_name ?>
</div> <!-- end kt-grid -->

<?php include('incs/footer_1.php') ?>
