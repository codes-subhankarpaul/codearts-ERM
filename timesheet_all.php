<hr><section class="employee-profiles">
    <div class="row">
        <?php 
            $sql1 = "SELECT * FROM capms_admin_users WHERE user_type != 'hr'";
            $result1 = mysqli_query($con, $sql1);
            if($result1->num_rows > 0)
            {
                while($row1 = mysqli_fetch_assoc($result1))
                {
                    if($row1['id'] != $_SESSION['emp_id']){

        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="employee-profiles-thubmnail">
                                <div class="dropdown employee-thumb-toggle">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)"><?php echo ucwords($row1['user_type']); ?></a>
                                        <a class="dropdown-item" href="employee_timesheet_log.php?user_id=<?php echo $row1['id']; ?>">Timesheet</a>
                                    </div>
                                </div>
                                <div class="employee-image">
                                    <a href="employee_timesheet_log.php?user_id=<?php echo $row1['id']; ?>"><img src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image']; ?>" alt=""></a>
                                </div>
                                <div class="employee-content">
                                    <a href="employee_access_log.php?user_id=<?php echo $row1['id']; ?>"><?php echo $row1['user_fullname']; ?></a>
                                    <h6><?php echo $row1['user_designation']; ?></h6>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
            }
        ?>
    </div>
</section>
<hr>