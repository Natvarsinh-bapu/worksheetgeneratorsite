<div style="display:flex;font-family:Arial;">
    <div style="
        margin:auto; 
        border:1px solid #f1f1f1;
        margin-top:10%; 
        border-radius:5px;
        font-family:Arial;
        background-color:#f1f1f1;
    ">
        <div style="height:300px;background-color:blue;margin-top:0;display:flex;">
            <div style="margin:auto;">
                <img src="{{ $icon }}" height="200px;" width="200px;">
            </div>
        </div>

        <div style="display:flex; justify-content:center;margin:20px 10px;">
            <h2>Email Confirmation</h2>
        </div>

        <div style="padding:30px;">
            <div>
                <h3>Hi, {{ $user_name }}</h3>
            </div>

            <div style="margin-top:10px;">
                This is the verification mail from the worksheet generator.
            </div>

            <div style="margin-top:10px;">
                <p>Click on verify link for further process.</p>
            </div>

            <div style="margin-top:10%; padding:5px; text-align:center;">
                <a href="{{ $link }}" style="border:2px solid blue; padding:10px 40px;;border-radius: 2px;color: blue;text-decoration: none;">
                    <b>Verify</b>
                </a>
            </div>
        </div>
    </div>
</div>