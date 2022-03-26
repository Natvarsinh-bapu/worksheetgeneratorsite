<style>    
    .layout-header-titles {
        border-bottom: 1px solid;
        margin-top: 10px;
    }
    .class-roll-div {
        display:flex;
        justify-content:space-between;
        border-bottom: 1px solid;
        margin-top:10px;
    }
</style>

<div id="print_div" style="background-color: #fff !important;">
    <div class="row">
        <div class="col-md-12">
            <div style="border: 1px solid;padding:5px;">
                <div class="layout-header-titles">
                    School name:
                </div>
                <div class="layout-header-titles">
                    Address:
                </div>
                <div class="layout-header-titles">
                    Student Name:
                </div>
                <div class="class-roll-div">
                    <div>Div</div>
                    <div>Class</div>
                    <div style="margin-right: 20%">Roll No.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div style="border: 1px solid;border-top:0;padding:5px;">
                <div class="layout-header-titles">
                    Q. &nbsp; <input type="text" name="question" placeholder="Type question here" style="border:none;width:90%;">
                </div>
            </div>
        </div>
    </div>

    <div style="border: 1px solid">
        @for ($i = 0; $i < 4; $i++)
            <div class="row">
                <div class="col-md-12">
                    <div style="display: flex;justify-content:space-around;text-align:center;padding:10px;margin-bottom: 35px;">
                        <div class="layout-4-div-el">
                            <div id="first_{{ $i }}" current-click="first_{{ $i }}" class="_image_box" style="height: 120px;margin: 5px;">
                                <img src="{{ asset('images/clickhere.png') }}" alt="" height="100%" width="100%">
                            </div>
                            <input class="layout-4-tb" type="text" name="text[]">
                        </div>                        
                        <div class="layout-4-div-el">
                            <div id="second_{{ $i }}" current-click="second_{{ $i }}" class="_image_box" style="height: 120px;margin: 5px;">
                                <img src="{{ asset('images/clickhere.png') }}" alt="" height="100%" width="100%">
                            </div>
                            <input class="layout-4-tb" type="text" name="text[]">
                        </div>                        
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <div class="row">
        <div class="col-md-12">
            <div style="border: 1px solid;border-top:0;padding:5px;display:flex;justify-content:space-between;padding-bottom:50px;">
                <div>
                    <div class="text-center">
                        <div style="padding: 10px">
                            <b>Teacher's Remarks</b>
                        </div>
                    </div>
                    <div>
                        <img class="rating-image-div" src="{{ url('images/excellent.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/good.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/average.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/normal.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/bad.png') }}" alt="">
                    </div>
                </div>
                <div>
                    <div class="text-center">
                        <div style="padding: 10px">
                            <b>Parents's Remarks</b>
                        </div>
                    </div>
                    <div>
                        <img class="rating-image-div" src="{{ url('images/excellent.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/good.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/average.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/normal.png') }}" alt="">
                        <img class="rating-image-div" src="{{ url('images/bad.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>