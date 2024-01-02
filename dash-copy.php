
<!-- Header is here -->
<?php include 'header.php'; ?>


<!-- Main Body is here -->

<main class="site-main">
    <div class="login-screen-main">
        <div class="login-screen">
            <h2>Login</h2>
            <form id="login-form">
                <input type="text" id="username" placeholder="Username">
                <input type="password" id="password" placeholder="Password">
                <button type="button" id="login-button">Login</button>
            </form>
            <p id="login-error" class="error-message"></p>
        </div>
    </div>

    <div class="sidebar-main">
        <div class="side-inner">
            <ul class="tabing-list">
                <li class="tab-item" data-tab="home">Home </li>
                <li class="tab-item" data-tab="teacher">Teacher</li>
                <li class="tab-item" data-tab="student">Student</li>
                <li class="tab-item" data-tab="editStudent">edit Student</li>
                <li class="tab-item" data-tab="about">About</li>
                <li class="tab-item" data-tab="logout" id="logout-link-msg">Log Out</li>
            </ul>
        </div>
    </div>

    <div class="site-content">
        <div class="site-con-inner">
            <div class="student-button">
                <div class="tab-content" id="home-content" data-tab-content="home"><div><h2>U.V Patel College</h2></div></div>
                <div class="tab-content" id="teacher-content" data-tab-content="teacher">Teacher</div>
                <div class="tab-content" id="student-content" data-tab-content="student">
                    <div class="button-section">
                        <div class="button-row">
                            <button class="button" id="information-button" onclick="toggleContent(1)">Information</button>
                            <button class="button" onclick="toggleContent(2)">Attandance</button>
                            <button class="button" onclick="toggleContent(3)">Material</button>
                            <button class="button" onclick="toggleContent(4)">Marks</button>
                        </div>
                        <div class="button-content">
                            <!-- Content sections for Information, Attendance, Material, and Marks go here -->
                            <div class="button-content">
                                <div class="content active">
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">Name: <span id="user-name"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">En No: <span id="user-enrollment"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">Course: <span id="user-course"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">Class: <span id="user-class"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">Batch: <span id="user-batch"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">Address: <span id="user-address"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">Hosteler/Transportation: <span id="user-hosteler"></span></label><br><br>
                                </div>
                                <div class="content">
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub1 lecture: <span id="sub1-lecture"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub1 lab: <span id="sub1-lab"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub2 lecture: <span id="sub2-lecture"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub2 lab: <span id="sub2-lab"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub3 lecture: <span id="sub3-lecture"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub3 lab: <span id="sub3-lab"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub4 lecture: <span id="sub4-lecture"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub4 lab: <span id="sub4-lab"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub5 lecture: <span id="sub5-lecture"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub5 lab: <span id="sub5-lab"></span></label><br><br>
                                </div>
                                <div class="content">
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub1 material: <span id="sub1-material"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub2 material: <span id="sub2-material"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub3 material: <span id="sub3-material"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub4 material: <span id="sub4-material"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub5 material: <br><span id="sub5-material"></span></label><br><br>
                                </div>
                                <div class="content">
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub1 marks: <span id="sub1-marks"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub2 marks: <span id="sub2-marks"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub3 marks: <span id="sub3-marks"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub4 marks: <span id="sub4-marks"></span></label><br><br>
                                    <label style="font-weight: bold; font-family: 'Times New Roman', Times, serif;">sub5 marks: <span id="sub5-marks"></span></label><br><br>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="editStudent-content" data-tab-content="editStudent">
                    <div class="button-section">
                        <div class="button-row">
                            <button class="button" id="edit-button" onclick="toggleContent(1)">Add</button>
                            <button class="button" onclick="toggleContent(2)">Update</button>
                            <button class="button" onclick="toggleContent(3)">Search</button>
                            <button class="button" onclick="toggleContent(4)">delete</button>
                        </div>
                        <div class="button-content">
                            <div class="content active">
                                add content here
                            </div>

                            <div class="content ">
                                Update content here
                            </div>

                            <div class="content ">
                                Search content here
                            </div>

                            <div class="content ">
                                Delete content here
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="tab-content" id="about-content" data-tab-content="about">About</div>


                
            </div>
        </div>
    </div>

</main>

 
<!-- Footer is here -->
<?php include 'footer.php'; ?>
