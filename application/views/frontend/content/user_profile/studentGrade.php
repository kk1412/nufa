<div id="main">
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">
        
        
        <!-- Start Full Width -->
        <div class="boxes-full">
        
            <div class="contacttitle">
            
                <h2><?php echo $_title; ?></h2>
            
            </div>
        
        	<div class="boxes-padding fullpadding">
            
            <div id="contactwarning"></div>
            <div id="contactajax"></div>
            
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						<tr>
							<th><center>Nama Pelajaran</center></th>
							<th><center>KKM</center></th>
							<th><center>Nilai</center></th>
							<th><center>Predikat</center></th>
							<th style="width:25%"><center>Pesan</center></th>
							<th style="width:10%"><center>Aksi</center></th>
						</tr>
					</thead>   
					<tbody>
						  <?php foreach($education_record as $education) { ?>
						  <tr>
								<td>
									<?php 
										echo "<b>" . $education->name_edu . "</b>"; 
										$grades = $this->mdl_grade->edu_records($this->uri->segment(4), $this->uri->segment(5), $education->id_edu)->result();
										echo "<ul>";
										foreach($grades as $grade) {
											echo "	<li>" . $grade->name_grade . "</li>";
										}
										echo "</ul>"
									?>
								</td>
								<td>
									<center>
										<?php
											echo "<b>" . $education->kkm . "</b>";
										?>
									</center>
								</td>
								<td>
									<center>
										<?php 
											foreach($grades as $grade) {
												echo "<br />";
												echo $grade->grade;
											}
										?>
									</center>
								</td>
								<td>
									<center>
										<?php 
											foreach($grades as $grade) {
												echo "<br />";
												echo ($education->kkm <= $grade->grade)?"Lulus":"Belum Lulus";
											}
										?>
									</center>
								</td>
								<td>
									<center>
										<?php 
											foreach($grades as $grade) {
												echo "<br />";
												echo ($grade->desc_grade != "" )?$grade->desc_grade :"-";
											}
										?>
									</center>
								</td>
								<td>
									<center>
										<?php 
											foreach($grades as $grade) {
												echo "<br />";
												echo '<a href="#'.base_url().'admin/student/grade/'.$id_user.'/'.$id_semester.'/update/'.$grade->id_grade.'" class="btn btn-info btn-mini" title="Perbaharui"><i class="icon-pencil icon-white"></i></a>'; 
												echo '<a href="#'.base_url().'admin/student/grade/'.$id_user.'/'.$id_semester.'/delete/'.$grade->id_grade.'" class="btn btn-danger btn-mini" title="Hapus" onClick="return confirm(\'Anda yakin ingin menghapus '.$grade->name_grade.' ?\')"><i class="icon-trash icon-white"></i></a>'; 
											}
										?>
									</center>
								</td>
						  </tr>
						  <?php } ?>
					</tbody>
				</table>
				
            
            </div>
            
            <span class="box-arrow"></span>
            
        </div>
        <!-- End Full Width -->
        
    </div>
    <!-- End Main Body Wrap -->

</div>
