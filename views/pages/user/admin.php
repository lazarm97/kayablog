<?php

if(isset($_SESSION['User'])):
    if($_SESSION['User']->function_id==1):
        require_once('../../config/connection.php');
        require_once('../../models/edit/functions/functions.php');
        $users = executeQuery("select * from users");
        $contents = executeQuery("select * from content");
        $authors = executeQuery("select * from author");
        $msgs = executeQuery("select * from messages");
?>

<div class="container">
    <div class="row col-12">
        <div class="col-6">
            <form>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select what you want to edit</label>
                    <select class="form-control" id="exampleFormControlSelect1" onchange="izaberi(this)">
                    <option value="0">Select</option>
                    <option value="1">User</option>
                    <option value="2">Content</option>
                    </select>
                </div>
                <div id="useredit">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">User id</label>
                        <select class="form-control" id="userId" onchange="selectedUser(this.options[this.selectedIndex].value)">
                        <option value="0">New</option>
                        <?php foreach($users as $user): ?>
                        <option value="<?= $user->id; ?>"><?= $user->fname." ".$user->lname; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">First name</label>
                        <input type="text" class="form-control" id="userFname" placeholder="1-10 characters">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Last name</label>
                        <input type="text" class="form-control" id="userLname" placeholder="1-10 characters">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="userEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Password</label>
                        <input type="text" class="form-control" id="userPass" placeholder="1-10 characters">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Function</label>
                        <select class="form-control" id="userFunction">
                        <option value="0">Select</option>
                        <option value="1">Administrator</option>
                        <option value="2">User</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" name="btnUserInsert" onclick="insertUser()">Insert</button>
                    <button type="button" class="btn btn-primary" name="btnUserUpdate" onclick="updateUser()">Update</button>
                    <button type="button" class="btn btn-primary" name="btnUserDelete" onclick="deleteUser()">Delete</button>
                </div>
                <div id="contentedit">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Content id</label>
                        <select class="form-control" id="contentId" onchange="selectedContent(this.options[this.selectedIndex].value)">
                        <option value="0">New</option>
                        <?php foreach($contents as $content): ?>
                        <option value="<?= $content->id; ?>"><?= $content->headline; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Href</label>
                        <input type="text" class="form-control" id="contentHref">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Alt</label>
                        <input type="text" class="form-control" id="contentAlt">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Src</label>
                        <input type="file" id="contentSrc" name="contentSrc" onchange="uploadImg()">
                        <span id="uploaded_img"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Date</label>
                        <input type="text" class="form-control" id="contentDate" placeholder="Format y-m-d example 2019-02-08">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Headline</label>
                        <input type="text" class="form-control" id="contentHeadline">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Content</label>
                        <textarea class="form-control" id="contentCont" rows="3"></textarea>
                    </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Full content</label>
                    <textarea class="form-control" id="contentFullCont" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Position</label>
                    <select class="form-control" id="contentPosition">
                    <option value="0">Select</option>
                    <option value="1">Naslovna</option>
                    <option value="2">Blok</option>
                    <option value="3">Kolona</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Category</label>
                    <select class="form-control" id="contentCategory">
                    <option value="0">Select</option>
                    <option value="1">Food</option>
                    <option value="2">Cooking</option>
                    <option value="3">Life style</option>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Author</label>
                        <select class="form-control" id="contentAuthor">
                        <option value="0">New</option>
                        <?php foreach($authors as $author): ?>
                        <option value="<?= $author->id; ?>"><?= $author->fullname; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="insertContent()">Insert</button>
                    <button type="button" class="btn btn-primary" onclick="updateContent()">Update</button>
                    <button type="button" class="btn btn-primary" onclick="deleteContent()">Delete</button>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Messages</label>
                    <select class="form-control" id="exampleFormControlSelect1" onchange="selectMsg(this.options[this.selectedIndex].value)">
                    <option value="0">Select</option>
                    <?php foreach($msgs as $msg): ?>
                    <option value="<?= $msg->id; ?>"><?= $msg->name; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group form-msg">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" class="form-control" id="msgEmail" readonly>
                </div>
                <div class="form-group form-msg">
                    <label for="exampleFormControlInput1">Text</label>
                    <textarea class="form-control" id="msgText" rows="3" readonly></textarea>
                </div>
                <div class="form-group form-msg">
                    <label for="exampleFormControlInput1">Date</label>
                    <input type="text" class="form-control" id="msgDate" readonly>
                </div>
            </form>
            <br>
            <?php
            $file = fopen(ABSOLUTE_PATH.'/data/log.txt', 'r');
            $podaci = file(ABSOLUTE_PATH.'/data/log.txt');
            foreach($podaci as $podatak=>$value){
                $delovi[] = explode("\t",trim($value)); 
            }
            fclose($file);
            
            echo "Trenutni broj ulogovanih korisnika je: ".brojUlogovanih();
            $poseceneStranice = poseceneStranice();
            $ukupanBrojStranica = ukupanBrojStranica($poseceneStranice);
            ?>
            <p>Broj poseta svim stranicama sa detaljima!(ograniceno na samo 10 prikaza)</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Rb</th>
                    <th scope="col">Stranica</th>
                    <th scope="col">Datum i vreme</th>
                    <th scope="col">IP</th>
                    </tr>
                </thead>
                <tbody>
                <?php $rb=1; for($i=0; $i<10; $i++): $j=0;?>
                <tr>
                    <th scope="row"><?=$rb++?></th>
                    <td><?=$delovi[$i][$j++]?></td>
                    <td><?=$delovi[$i][$j++]?></td>
                    <td><?=$delovi[$i][$j++]?></td>
                </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div> 
    </div>
    <div class="row col-12">
        <div class="col-6">
            <p>Broj poseta stranica u procentima!</p>
            <a href="../../models/export/statisticToExcel.php" class="btn btn-success">
                EXPORT TO EXCEL
              </a><br><br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rb</th>
                        <th scope="col">Stranica</th>
                        <th scope="col">Broj Poseta</th>
                    </tr>
                </thead>
                <tbody>
                <?php $rb=1; for($i=0; $i<count($poseceneStranice); $i++):?>
                        <tr>
                        <th scope="row"><?=$rb++?></th>
                        <td><?=$poseceneStranice[$i]?></td>
                        <td><?=round(100*(brojPosecenostiStranice($poseceneStranice[$i])/$ukupanBrojStranica),2).'%'?></td>
                        </tr>
                        <?php endfor; ?>
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <p>Broj poseta stranica u protekla 24 sata!</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rb</th>
                        <th scope="col">Stranica</th>
                        <th scope="col">Broj Poseta</th>
                    </tr>
                </thead>
                <tbody>
                <?php $rb=1; for($i=0; $i<count($poseceneStranice); $i++):?>
                        <tr>
                        <th scope="row"><?=$rb++?></th>
                        <td><?=$poseceneStranice[$i]?></td>
                        <td><?=brojPosecenostiStraniceProtekla24Sata($poseceneStranice[$i]);?></td>
                        </tr>
                        <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Jquery-2.2.4 js -->
    <script src="../../assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="../../assets/js/admin.js"></script>

    <?php endif; else: echo "nije dozvoljen pristup preko url adrese!"; endif; ?>