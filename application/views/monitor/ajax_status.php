
                    <table id="tabel-dept" class="table  table-hover table-sm">
                    <thead>
                    <tr>
                    <th>Waktu</th>
                    <th>Mesin</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=0;
                      foreach($status as $item)
                      {
                        if($item->status==0)
                        {
                          $status_mesin = "STOP";
                          $kelas = "table-danger";
                        }
                        elseif($item->status==1)
                        {
                          $status_mesin = "RUN";
                          $kelas = "table-warning";
                        }
                        elseif($item->status==2)
                        {
                          $status_mesin = "PRODUCTION";
                          $kelas = "table-success";
                        }
                        elseif($item->status==3)
                        {
                          $status_mesin = "JOG";
                          $kelas = "table-info";
                        }
                        $no++;
                        echo"
                        <tr>
                        <td>$item->waktu</td>
                        <td>$item->nama_mesin</td>
                        <td class='$kelas'>$status_mesin</td>
                        </tr>
                        ";
                      }
                    ?>
                    </tbody>
                    </table>