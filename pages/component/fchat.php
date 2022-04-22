<div class="col-12 col-md-12 col-lg-7 order-2 order-md-1">
  <div class="col-12">
    <h4 class="text-muted mb-3">Note History</h4>

      <?PHP
        if (!empty($_GET['appid'])){
          $sql_note = "SELECT an.status,an.note,an.data_update,an.user_update,an.user_group,
            DATE_FORMAT(an.data_update,'%d %b %Y %r') AS data_update, an.user_update  
            FROM apply_note an 
            LEFT JOIN gen_users gu ON an.user_update = gu.user_id 
            WHERE an.data_id = '$_GET[appid]' 
            ORDER BY an.data_update DESC";
          //echo $sql_note;
          $xsql_note = mysqli_query($koneksi, $sql_note);
          while($arsql_note = mysqli_fetch_array($xsql_note)){
            $user_note_id = $arsql_note['user_update'];
            $sql_meta = "SELECT gum.user_id,
              (
                SELECT meta_value 
                FROM gen_usermeta 
                WHERE meta_key = 'first_name' AND user_id = gum.user_id
              ) AS first_name,
              (
                SELECT meta_value 
                FROM gen_usermeta 
                WHERE meta_key = 'last_name' AND user_id = gum.user_id
              ) AS last_name,
              (
                SELECT meta_value 
                FROM gen_usermeta 
                WHERE meta_key = 'user_picture' AND user_id = gum.user_id
              ) AS user_picture
              FROM gen_usermeta gum 
              WHERE gum.user_id = '$user_note_id' 
              GROUP BY gum.user_id";
            $xsql_meta = mysqli_query($koneksi,$sql_meta);
            $arsql_meta = mysqli_fetch_array($xsql_meta);

            $nama_note_user = $arsql_meta['first_name'].' '.$arsql_note['last_name'];
            $picture_note_user = $arsql_meta['user_picture'];
            $group_note_user = $arsql_note['user_group'];
            $date_note_update = $arsql_note['data_update'];
            $status_note = $arsql_note['status'];
            $note = nl2br($arsql_note['note']);
            ?>

            <div class="row">          
              <div class="card col-sm-12 elevation-0">
                
                <div class="card-header bg-lightgray" style="border-style: none;" data-card-widget="collapse">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?PHP echo $picture_note_user; ?>" alt="user image">
                    <span class="username">
                      <a href="#">
                        <?PHP echo $nama_note_user; ?>
                        <label class="badge badge-secondary ml-2"><?PHP echo $status_note; ?></label>
                      </a>
                    </span>
                    <span class="description" style="font-size:14px;">
                      <?PHP echo $group_note_user; ?> - <?PHP echo $date_note_update; ?>                            
                    </span>
                  </div>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus text-lightblue"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body" style="margin-top:-10px;">
                  <?PHP echo $note; ?>
                  <hr>
                </div>                      

              </div>
            </div>

            <?PHP
          }
        }    
      ?>

  </div>        
</div>