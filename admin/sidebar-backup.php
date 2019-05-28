			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
					<?php
												
						if ($user_access == 1 || $user_access == 2){
							echo "<li>
									<a href='index.php'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a>
								</li>
								<li>
									<a href='student.php'><i class='fa fa-fw fa-forward'></i> Enrollment / Registration</a>
								</li>
								<li>
									<a href='enrolled.php'><i class='fa fa-fw fa-users'></i> Students</a>
								</li>
								
								<li>
									<a href='offence.php'><i class='fa fa-fw fa-warning'></i> Offences</a>
								</li>
								<li>
									<a href='schoolyear.php'><i class='fa fa-fw fa-calendar'></i> School Year</a>
								</li>
								<li>
									<a href='gradelevel.php'><i class='fa fa-fw fa-line-chart'></i> Grade Level</a>
								</li>
								<li>
									<a href='section.php'><i class='fa fa-fw fa-cube'></i> Section</a>
								</li>
								<li>
									<a href='subject.php'><i class='fa fa-fw fa-cubes'></i> Subject</a>
								</li>
								<li>
									<a href='faculty.php'><i class='fa fa-fw fa-user'></i> Faculty</a>
								</li>
								<li>
									<a href='advisory.php'><i class='fa fa-fw fa-eye'></i> Advisory</a>
								</li>
								<li>
									<a href='subject_teacher.php'><i class='fa fa-fw fa-check-square-o'></i> Subject Teacher</a>
								</li>
								<li>
			                        <a href='javascript:;' data-toggle='collapse' data-target='#subjects'><i class='fa fa-fw fa-arrows-v'></i> Subjects <i class='fa fa-fw fa-caret-down'></i>
			                        </a>
			                        <ul id='subjects' class='collapse'>
			                            <li>
			                                <a href='#'>Category</a>
			                            </li>
			                            <li>
			                                <a href='#'>Subject List</a>
			                            </li>
			                        </ul>
			                    </li>
								";
						}
						
						if ($user_access == 1 || $user_access == 2 || $user_access == 3){
							echo "<li>
									<a href='grade.php'><i class='fa fa-fw fa-clipboard'></i> Grades</a>
								</li>
								<li>
									<a href='ranking.php'><i class='fa fa-fw fa-bar-chart'></i> Ranking</a>
								</li>";
						}
						
						if ($user_access == 1 || $user_access == 2 || $user_access == 4){
							echo "<li>
									<a href='account.php'><i class='fa fa-fw fa-list'></i> Account</a>
								  </li>
								  <li>
									<a href='tuition.php'><i class='fa fa-fw fa-money'></i> Tuition Fee</a>
								  </li>";
						}
						
						if ($user_access == 1){
							echo "<li>
									<a href='user.php'><i class='fa fa-fw fa-key'></i> User Account</a>
								  </li>";
						}
					
					?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->