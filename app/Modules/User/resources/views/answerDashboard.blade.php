<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ANSWER DASHBOARD</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('assets/css/style1.css')}}" rel="stylesheet">
</head>
<body>
<section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
        <div class="text-center">
                    <h1 style="font-family: cursive; margin"><b>ONLINE QUIZ EXAM</b></h1>
</div>
            <div class="row d-flex justify-content-center align-items-center h-100 background-color:#fff3edf;">
                
                <div class="">
                    <div class="card" id="divblack"style=" border-radius: 1rem; ">
                        <div class="card-body p-5 text-center background-color:#fff3edf;">
                            <span value="0" max="10" id="progressBar" style="float:right;font-size:20px; 7"></span>
                            <span id="qelement">Q.<span id="num" ></span></span> 
                            <h3 id="question" class="element1"></h3><br>

                            <div class="row">
                            <div class="col-sm-6 element1" id = "color1" onclick = "val1()" style="background-color:#c7c7c7f7; padding: 19px; border: solid 2px black;">
                            <span id="option1" ></span><br>
                            </div>
                            <div class="element1 col-sm-6" id = "color2" onclick = "val2()" style="background-color:#c7c7c7f7;padding: 19px;border:solid 2px black; ">
                            <span id="option2" ></span><br>
                            </div>
                            <div class="element1 col-sm-6" id = "color3" onclick = "val3()" style="background-color:#c7c7c7f7; padding: 19px; border:solid 2px black;">
                            <span id="option3" ></span><br>
                            </div>
                            <div class="element1 col-sm-6" id = "color4" onclick = "val4()" style="background-color:#c7c7c7f7; padding: 19px; border: solid 2px black;">
                            <span id="option4" ></span><br><br>
                            </div>
                            </div>

                            <button id="btnsubmit" onclick="submit()" class="btn btn-primary btn-lg" style="visibility:hidden">Submit</button><br>
                            <button id="btnnext" onclick="next()" class="btn btn-primary btn-lg">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html> 


<script>
        var arr = {!! json_encode($data) !!};
        var i=1; // count of data taking
        let html="";
        let user_ans = [] ;
        let que_id = [arr[0]['id']];

        var timeleft = 10;
        var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
        }

        document.getElementById("progressBar").innerHTML = timeleft;
        timeleft -= 1;
            if(timeleft == 0 && i != 10 ){
                next();
            }else if(i == 10 && timeleft == 0){
                    submit();
            }
        }, 1000); 

    run();

    function next(){       
            empt();
            timeleft = 10;
            i++;
            run();
            user_ans.push(html);
            html = "";     
            que_id.push(arr[i-1]['id']);
            removecolor();

    }
        
    function run(){
        if(i < 10){
            document.getElementById("num").innerHTML = i;
            document.getElementById("question").innerHTML = arr[i-1]['question'];
            document.getElementById("option1").innerHTML = arr[i-1]['option1'];
            document.getElementById("option2").innerHTML = arr[i-1]['option2'];
            document.getElementById("option3").innerHTML = arr[i-1]['option3'];
            document.getElementById("option4").innerHTML = arr[i-1]['option4'];
            }else if( i== 10){
            document.getElementById("num").innerHTML = i;
            document.getElementById("question").innerHTML = arr[i-1]['question'];
            document.getElementById("option1").innerHTML = arr[i-1]['option1'];
            document.getElementById("option2").innerHTML = arr[i-1]['option2'];
            document.getElementById("option3").innerHTML = arr[i-1]['option3'];
            document.getElementById("option4").innerHTML = arr[i-1]['option4'];
            document.getElementById("btnnext").style.visibility = "hidden";
            document.getElementById("btnsubmit").style.removeProperty("visibility");
        }
        else{
            document.getElementById("question").innerHTML = "error";
            document.getElementById("qelement").innerHTML = ""; 
            document.getElementById("btnnext").style.visibility = "hidden";
            document.getElementById("btnsubmit").style.visibility = "hidden";
            document.getElementById("divblack").classList.remove("card");
        }
    }

        function empt(){
        document.getElementById("num").innerHTML = "";
        document.getElementById("question").innerHTML = "";
        document.getElementById("option1").innerHTML = "";
        document.getElementById("option2").innerHTML = "";
        document.getElementById("option3").innerHTML = "";
        document.getElementById("option4").innerHTML = "";
    }

    function val1(){
        html = "";
        html += document.getElementById("option1").innerHTML;
        removecolor();
        document.getElementById("color1").style.backgroundColor = "rgb(56 231 132)";

    }
    function val2(){
        html = "";
        html = document.getElementById("option2").innerHTML;
        removecolor();
        document.getElementById("color2").style.backgroundColor = "rgb(56 231 132)";

    }
    function val3(){
        html = "";
        html = document.getElementById("option3").innerHTML;
        removecolor();
        document.getElementById("color3").style.backgroundColor = "rgb(56 231 132)";

    }
    function val4(){
        html = "";
        html = document.getElementById("option4").innerHTML;
        removecolor();
        document.getElementById("color4").style.backgroundColor = "rgb(56 231 132";

    }



    function submit(){

    user_ans.push(html);

        $.ajax({
                    type: 'post',
                    url: '{{ route('quiz-submit') }}',
                    data:{
                        _token: '{{csrf_token()}}',
                        user_ans:user_ans,
                        que_id:que_id

                    },
                    success:function(data){
                        console.log(data.success);
                        window.location="{{route('user-endquiz')}}";
                    }
            });
        }

    function removecolor(){
        document.getElementById("color1").style.backgroundColor  = "rgb(188 198 208)";
        document.getElementById("color2").style.backgroundColor  = "rgb(188 198 208)";
        document.getElementById("color3").style.backgroundColor  = "rgb(188 198 208)";
        document.getElementById("color4").style.backgroundColor  = "rgb(188 198 208)";
    }

    </script>