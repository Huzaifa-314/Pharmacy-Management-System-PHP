
    <?php include 'include/header.php'; ?>


    <div class="user-area">
        <div class="container-fluid">
            <div class="row">
                <div class="user-sidebar col-md-2 pt-3">
                    <div class="user-info mb-3  ">
                        <div class="user-image d-flex align-items-center  ml-3  ">
                            <img src="" alt="" height="180px" width="180px" class="User-pic">
                        </div>
                        <div class="user-name">User Name</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="user-item">
                        <ul class="tab">
                            <li><button class="tablinks3 tablinks" onclick="openTab(event,'Tab3')"><i class="fa fa-angle-double-right"> Profile</i></button></li>
                            <li><button class="tablinks1 tablinks" onclick="openTab(event,'Tab1')" id="defaultOpen"><i class="fa fa-angle-double-right"> Order History</i></button></li>
                            <li><button class="tablinks2 tablinks" onclick="openTab(event,'Tab2')"><i class="fa fa-angle-double-right"> Prescription History</i></button></li>
                            <li><button class="tablinks4 tablinks" onclick="openTab(event,'Tab4')"><i class="fa fa-angle-double-right"> Logout</i></button></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <br>
                    <div id="Tab1" class="orderHistory tabcontent">
                        <div>No order history found</div>
                    </div>
                    <div id="Tab2" class="perscriptionHistory tabcontent">
                        <div class="description">
                            <strong>কেন প্রেসক্রিপশনের ছবি আপলোড করবেন?</strong>
                            <ul>
                                <li>১. আপনি প্রেসক্রিপশন বুজতে না পারলেও কোন সমস্যা নেই, আমাদের 'A' গ্রেড ফার্মাসিস্ট প্রেস্ক্রিপশন দেখে ঔষধ অর্ডারে আপনাকে সহযোগিতা করবে।</li>
                                <li>২. বাংলাদেশ সরকারের নিয়ম অনুসারে, কিছু মেডিসিন অর্ডার করার জন্য প্রেসক্রিপশন থাকা বাধ্যতামূলক।</li>
                            </ul>
                        </div>
                        <div class="prescription-upload mt-3">
                            <p>Select Prescription</p>

                            <input type="file" id="" name="">
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>







    <?php include 'include/footer.php'; ?>
