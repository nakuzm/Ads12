    <form  method="post">
        <div style="width: 50%; margin: 0 auto;">
            <div style="margin-bottom: 10px;">
                <div style="font-weight: 600;">
                    <label for="fld_server_name">Server name:</label>
                </div>
                <div>
                    <input type="text" style="height: 25px; width: 50%;" value="" name="server_name" id="fld_server_name">
                </div>
            </div>
            <div style="margin-bottom: 10px;">
                <div style="font-weight: 600;">
                    <label for="fld_user_name">User name:</label>
                </div>
                <div>
                    <input type="text" style="height: 25px; width: 50%;" value="" name="user_name" id="fld_user_name">
                </div>
            </div>
            <div style="margin-bottom: 10px;">
                <div style="font-weight: 600;">
                    <label for="fld_password">Password:</label>
                </div>
                <div>
                    <input type="text" style="height: 25px; width: 50%;" value="" name="password" id="fld_password">
                </div>
            </div>
            <div style="margin-bottom: 10px;">
                <div style="font-weight: 600;">
                    <label for="fld_database">Database:</label>
                </div>
                <div>
                    <input type="text" style="height: 25px; width: 50%;" value="" name="database" id="fld_database">
                </div>
            </div>
            <div style="margin-bottom: 40px;">
                <input type="submit" value="Install" name="main_form_submit"> 
            </div>
            <div>{$show_link}</div>
        </div>
    </form>