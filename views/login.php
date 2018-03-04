<?php
class LoginView {
    function show(){
        echo 
        '<div class="container">
                <div class="row">
                    <div class="col-xs-offset-3"></div>
                    <div class="col-xs-6">
                        <h2>Please log into your account</h1>
                        <form action="" method="post">
        
                                <label>Email:</label>
                                <input name="email" type="text" ><br>
                                <label>Password:</label>
                                <input name="password" type="text"><br>
                                <input type="submit" name="submit" value="Log in">
        
                        </form>
                        
                       
                    </div>
                    <div class="col-xs-3"></div>
                </div>
            </div>
        </body>
        </html>';
    }
}
