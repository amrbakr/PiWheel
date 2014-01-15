<?php if ($logged): ?>
    <header class="header loggedin clearfix">
    <div class="container clearfix">
        <h1 class="logo"><a href="<?php echo base_url(); ?>"></a></h1>
        <nav class="loggedin-nav">
            <ul>
                <li class="user"><a href="<?php echo base_url().'profile/'.$this->session->userdata['Username']; ?>">Welcome,<br><?php echo $this->session->userdata['Fullname'] ?></a></li>
                <li class="home"><a href="<?php echo base_url(); ?>"></a></li>
                <li class="settings">
                    <a href="javascript:void(0);" rel="nofollow"></a>

                    <div class="dropdown-nav">
                        <span class="arrow"></span>
                        <ul>
                        <li><a href="javascript:void(0);" data-jbox-title="Edit Email" data-jbox-content="edit_email_box" rel="nofollow">Edit&nbsp;Email</a></li>
                        <li><a href="javascript:void(0);" data-jbox-title="Edit Password" data-jbox-content="edit_password_box" rel="nofollow">Edit&nbsp;Password</a></li>
                        <li><a href="javascript:void(0);" data-jbox-title="Withdrawal Options" data-jbox-content="withdrawal_options_box" rel="nofollow">Withdrawal&nbsp;Options</a></li>
                        <li><a href="javascript:void(0);" data-jbox-title="Transactions" data-jbox-content="transactions_box" rel="nofollow">Transactions</a></li>
                        </ul>
                    </div>

                </li>
                <li class="logout"><a href="<?php echo base_url() ?>logout"></a></li>
            </ul>
        </nav>
    </div>
</header>
<?php endif ?>

<div class="container clearfix">

<?php if (!$logged): ?>
    <header class="header clearfix">
    <h1 class="logo"><a href="index.html"></a></h1>

    <div class="user-area clearfix">
        <?php if(!$logged): ?>
        <a rel="nofollow" href="#register-instructor" data-modal="reg-instructor" class="reg-instructor">I&#039;m an Instructor</a>
        <?php else: ?>
            <a rel="nofollow" href="profile/<?php echo $this->session->userdata['Username'] ?>" class="reg-instructor">
                <?php echo $this->session->userdata['Fullname']; ?>
            </a>
        <?php endif;  ?>
        </a>
        <div class="cb"></div>
        <div class="search">
            <a rel="nofollow" href="javascript:void(0);" class="btn-search" id="btn-search"></a>
            <input type="text" class="search-box" id="search-box" value="What do you like to learn?" placeholder="What do you like to learn?">
        </div>
        <a rel="nofollow" href="javascript:void(0);" class="btn btn-login" data-dropdown="#login" data-gal="leanModal"><span>Login</span></a>
        <a rel="nofollow" href="javascript:void(0);" class="btn btn-lang"><span>EN</span></a>
    </div> <!-- .user-area -->
</header>
<?php endif ?>

<div id="lean_overlay"></div>
<div id="reg-instructor" class="modal wide"   style="display: none; position: absolute; opacity: 1; z-index: 11000; left: 50%; margin-left: -405px; top: 5px;">
    <a class="modal-close">X</a>
    

    <form class="two-columns-form" action="register" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" value="register">
        <div class="modal-header">
            <h3>Personal info</h3>
        </div>
       <div class="modal-body">
            
          <table class="tableInput">
          
          <tr>
              <td width="35%"><p>Prefix</p></td>
              <td><select name="prefix"><option>Mr</option><option>Mrs</option></select></td>
          </tr>    

          <tr>
              <td>
                <p class="register-name">Full Name</p>
              </td>
              <td>
                  <input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>">
              </td>
          </tr> 

          <tr>
          
              <td colspan=>
                   <?php 
                    $errortext = form_error('fullname');
                    if (isset($registerInstructorFailure) && $errortext != ""): ?>
                    <td><h4 class="alert_error" style="color:red"><?php echo form_error('fullname');  ?></h4></td>
                    <?php endif ?>
              </td>
          </tr>

          <tr>
                <td><p>Title</p></td>
                <td><input type="text" name="title" value="<?php echo set_value('title'); ?>"></td>
                </tr>
                <tr>
                    <td>
                         <?php 
                        $errortext = form_error('title');
                        if (isset($registerInstructorFailure) && $errortext != ""): ?>
                        <td><h4 class="alert_error" style="color:red"><?php echo form_error('title');  ?></h4></td>
                        <?php endif ?>
                    </td>
                </tr>

                <tr style="margin-bottom:20px;">
                    <td style="vertical-align: middle" >Image</td>
                    <td style="vertical-align: middle">
                        <p class="register-image">
                        <img src="<?php echo base_url(); ?>application/img/avatar.png" alt="">
                        <label for="inst-photo" class="label-btn">Upload Image</label>
                        <span class="filename"></span>
                        <input type="file" name="userfile" id="inst-photo" class="unvisible" accept="image/jpeg,image/gif,image/png">
                        </p>
                    </td>
                </tr>

                <tr>
                    <td>

                         <?php 
                        if (isset($registerInstructorImageFailure)): ?>
                        <td>
                            <h4 class="alert_error" style="color:red">
                                <?php echo $registerInstructorImageFailure;  ?>
                            </h4>
                        </td>
                        <?php endif ?>
                    </td>
                </tr>
    

                <tr>
                    <td style="vertical-align: top">Bio</td>
                    <td><textarea id="registerTextarea" name="About">
                    <?php 
                    $text = set_value('About');
                    if($text)
                        echo $text;
                    ?>
                    </textarea></td>
                </tr>
                <tr>
                    <td>
                         <?php 
                        $errortext = form_error('About');
                        if (isset($registerInstructorFailure) && $errortext != ""): ?>
                        <td><h4 class="alert_error" style="color:red"><?php echo form_error('About');  ?></h4></td>
                        <?php endif ?>
                    </td>
                </tr>
          </table>
            
        </div>
        <div class="modal-header">
            <h3>Login info</h3>
        </div>
        <div class="modal-body">
            <table class="tableInput">
                <tr>
                    <td width="35%">Email</td>
                    <td><input type="text" name="email" id="user-email" value="<?php echo set_value('email'); ?>"></td>
                </tr>
                 <tr>
                    <td>
                         <?php 
                        $errortext = form_error('email');
                        if (isset($registerInstructorFailure) && $errortext != ""): ?>
                        <td><h4 class="alert_error" style="color:red"><?php echo form_error('email');  ?></h4></td>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr style="margin-top:10px">
                    <td>Password</td>
                    <td><input type="password" name="password" value="<?php echo set_value('password'); ?>" id="user-password"></td>
                </tr>
                 <tr>
                    <td>
                         <?php 
                        $errortext = form_error('password');
                        if (isset($registerInstructorFailure) && $errortext != ""): ?>
                        <td><h4 class="alert_error" style="color:red"><?php echo form_error('password');  ?></h4></td>
                        <?php endif ?>
                    </td>
                </tr>
            </table>
            <!-- <p><label for="user-email">Email</label><input type="text" name="email" id="user-email"></p> -->
            <!-- <p><label for="user-password">Password</label><input type="password" name="password" id="user-password"></p> -->
        </div>
        <!-- <div class="modal-header">
            <h3>Certification</h3>
        </div>
        <div class="modal-body">
            <p><label>Certification</label><input type="text" name="certification[]"></p>
            <p><label>Accredited by</label><input type="text" name="accredited_by[]"></p>
            <p><label>Verification link</label><input type="text" name="v_link[]"></p>
            <p class="add-certificate"><a href="#">+Add Another Certification</a></p>
        </div> -->
        <div class="modal-footer">
            <button>Register</button>
        </div>
    </form>
</div> <!-- #reg-instructor -->

<div id="register-student"   style="display: none; position: absolute; opacity: 1; z-index: 11000; left: 50%; margin-left: -405px; top: 100px;" class="modal wide">
    <a class="modal-close">X</a>
    <form class="two-columns-form" method="POST" action="register">
    <?php if (isset($registerTrial)): ?>
        <script>var autoPopup = "register-student";</script>
    <?php endif ?>
    <?php if (isset($registerInstructorFailure)): ?>
        <script>var autoPopup = "reg-instructor";</script>
    <?php endif ?>
    <input type="hidden" name="type" value="student">
        <div class="modal-header">
            <h3>Login info</h3>
        </div>
        <div class="modal-body">
            <table class="tableInput">
                <tr>
                    <td><label>Email</label></td>
                    <td><input name="email" type="text" value="<?php echo set_value('email'); ?>" /></td>
                    <?php 
                    $errortext = form_error('email');
                    if (isset($registerFailure) && $errortext != ""): ?>
                    <td><h4 class="alert_error"><?php echo form_error('email');  ?></h4></td>
                    <?php endif ?>
                </tr>
            </table>
            <table class="tableInput">
                <tr>
                    <td><label>Password</label></td>
                    <td><input name="password" type="password" value="<?php echo set_value('password'); ?>" /></td>
                    <?php
                    $errortext = form_error('password');
                    if (isset($registerFailure) && $errortext != ""): ?>
                    <td><h4 class="alert_error"><?php echo form_error('password');  ?></h4></td>
                    <?php endif ?>
                </tr>
            </table>
            
        </div>
        <div class="modal-header">
            <h3>Personal info</h3>
        </div>
        <div class="modal-body">
            <table class="tableInput">
                <tr>
                    <td><label>Full Name</label></td>
                    <td><input name="fullname" type="text" value="<?php echo set_value('fullname'); ?>" /></td>
                    <?php 
                    $errortext = form_error('fullname');
                    if (isset($registerFailure) && $errortext != ""): ?>
                    <td><h4 class="alert_error"><?php echo form_error('fullname');  ?></h4></td>
                    <?php endif ?>
                </tr>
            </table>

            <table class="tableInput">
                <tr>
                    <td><label>Gender</label></td>
                    <td>
                    <select name="gender">
                        <?php 
                        $selected = set_value('gender');
                        $values = array("0"=>"","1"=>"Male","2"=>"Female");
                        foreach ($values as $key => $value) {
                            if($selected != $key)
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        else
                            echo '<option selected="selected" value="'.$key.'">'.$value.'</option>';
                        }
                        ?>
                        </select>
                    </td>
                    <?php 
                    $errortext = form_error('gender');
                    if (isset($registerFailure) && $errortext != ""): ?>
                    <td><h4 class="alert_error"><?php echo form_error('gender');  ?></h4></td>
                    <?php endif ?>
                </tr>
            </table>

            <table class="tableInput">
            <tr>
                <td>
                <p class="register-dob">
                    <label>Birth date</label>
                <select name="birth-day">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                    <option>21</option>
                    <option>22</option>
                    <option>23</option>
                    <option>24</option>
                    <option>25</option>
                    <option>26</option>
                    <option>27</option>
                    <option>28</option>
                    <option>29</option>
                    <option>30</option>
                    <option>31</option>
                </select>
                <select name="birth-month">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
                <select name="birth-year">
                    <?php $years = range(1950,idate("Y")); ?>
                    <?php foreach ($years as $year): ?>
                        <option value="<?php echo $year; ?>"> <?php echo $year; ?></option>
                    <?php endforeach ?>
                </select></p>
                </td>
                    <?php 
                    $errortext = form_error('dob');
                    if (isset($registerFailure) && $errortext != ""): ?>
                    <td><h4 class="alert_error"><?php echo form_error('dob');  ?></h4></td>
                    <?php endif ?>
            </tr>
            
                
                </table>
           <!--  <p><label for="certification">Certification</label><input type="text" id="certification" name="certification" /></p> -->
        </div>
        <!-- <div class="modal-header">
            <h3>Payment Info</h3>
        </div>
        <div class="modal-body">
            <p class="radio-controllers"><input type="radio" name="payment-method" id="credit-card" /><label for="credit-card"><img src="img/visa-master.png" alt="Visa &amp; Master Card" /></label><input type="radio" name="payment-method" id="paypal" /><label for="paypal"><img src="img/paypal.png" alt="Paypal" /></label></p>
            <p class="credit-card-name">
                <label>Credit Card</label>
                <input type="text" placeholder="First Name" style="width:180px;" />
                <input type="text" placeholder="Last Name" style="width:180px;" />
            </p>
            <p>
                <label for="card-number">Card No.</label>
                <input type="text" name="card-number" id="card-number" style="width:380px;" />
            </p>
            <p class="register-dob">
                <label>Exiration</label>
                <select name="expiration_month">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
                <select name="expiration_year">
                    <option>1991</option>
                    <option>1992</option>
                    <option>1993</option>
                    <option>1994</option>
                    <option>1995</option>
                    <option>1996</option>
                    <option>1997</option>
                    <option>1998</option>
                    <option>1999</option>
                    <option>2000</option>
                </select>
                <input type="text" name="expiration_code" class="expiration-code" placeholder="Ex. Code" />
            </p>
        </div> -->
        <div class="modal-footer">
            <button>Register</button>
        </div>
    </form>
</div> <!-- #register-student -->

<div id="login" class="dropdown dropdown-tip dropdown-anchor-right">
    <div class="dropdown-panel navy">
        <form action="<?php echo base_url(); ?>login" method="POST">
        <input type="hidden" name="currentURL" 
                value="<?php echo substr($_SERVER['REQUEST_URI'],9); ?>">
            <div class="input-group">
                <span class="input-group-addon username"></span>
                <input type="text" name="username" placeholder="User Name"
                value="<?php echo set_value('username');?>"
                 required>
            </div>
            <div class="input-group">
                <span class="input-group-addon password"></span>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <?php
                if(isset($login_error)){
                echo '<input type="hidden" id="loginTrial" >';  
                $text = $login_error;
                if($text){
                echo '<h4 class="alert_error">'.$text.'</h4>';
                }
             }
            ?>
            <button>Login</button> 
            <a href="#register-student" data-modal="register-student" data-gal="leanModal" class="toggle-register">Register</a>
        <?php form_close(); ?>    
        </form>
    </div>
</div>