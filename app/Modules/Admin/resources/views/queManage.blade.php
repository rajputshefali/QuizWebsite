<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>
<body>
   <!-- Button trigger modal -->
   <br><br><br><br>
<button type="button" class="btn btn-primary centered" data-bs-toggle="modal" data-bs-target="#addQnamodal">
    ADD Q&A
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="addQnamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Q&A</h1>
          <button id="addAnswer" class="ml-7 btn btn-info">Add Answers</button>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span area-hidden="true"&times;</span></button>
        </div>
        <form id="addQna">
          @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col">
                <input type="text" class="w-100" name="question" id="question" placeholder="enter question" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <span class="error" style="color: red"></span>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button"  class="btn btn-primary"> Add QnA</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){

        //form-submition
       $("#addQna").submit(function(e){
         e.preventDefault();
        //  $(".answers").val()
        // var question = $("#question").val();        

         if($(".answers").length < 2)
         
         {
            $(".error").text("please add minimum 2 answers")
            setTimeout(function(){
                $(".error").text("");
            }, 2000);
           
         }
         else{
              var checkIsCorrect = false;
              for(let i=0 ; i< $(".is_correct").length; i++){
                if($(".is_correct:eq("+i+")").prop('checked')== true)
                {
                  checkIsCorrect =true;
                  $(".is_correct:eq("+i+")").val($(".is_correct:eq("+i+")").next().find('input').val() );
                }
              }
              if(checkIsCorrect)
              {
                var formData = $(this).serialize();
                $.ajax({
                  url:"{{ route('addQna') }}",
                  type: "POST",
                  data: {
                    _token: '{{csrf_token()}}',
                    data:formData,
                    // question:question,
                    // answers:answers,
                  },
                  success:function(data){
                   
                    if(data.success == true)
                    {
                     location.reload();
                    }else{
                      alert(data.msg);
                    }
                  }

                });

              }else{
                $(".error").text("please choose one correct answer")
                setTimeout(function(){
                $(".error").text("");
            }, 2000);
              }
           
         }

       });


       //add-answers
       $("#addAnswer").click(function(){
        if($(".answers").length >= 4)
         
         {
            $(".error").text("you can add maximum 4 answers")
            setTimeout(function(){
                $(".error").text("");
            }, 2000);
           
         }
         else{
          var html=
          `
          <div class="row mt-2 answers">
            <input type="radio" name="is_correct" class="is_correct">
            <div class="col">
                <input type="text" class="w-100" name="answers[]" id="answers"  placeholder="enter your answers" required>
            </div>
            <button class="btn btn-danger removeButton">Remove</button>
          </div>
          `};


          $(".modal-body").append(html);
          console.log(html); 

         
          
       });

       $(document).on("click", ".removeButton", function(){
             $(this).parent().remove();
       });

    });
    </script>