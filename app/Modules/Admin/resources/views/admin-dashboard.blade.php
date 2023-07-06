<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/show.css">
    
</head>
<body>
    
    <section id="sidebar">
       
        <div class="sidebar-brand">
            <h2><i class="fa-solid fa-desktop"></i><span>&nbsp;ADMIN DASHBOARD</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                
                <li><a id="user_manage" href="/usermanagement"><i class="fa fa-user"></i><span>MANAGE USER</span></a></li>
                <li><a id="" href="/queadd"><i class="fa-solid fa-file-circle-question"></i><span>ADD QUIZ QUESTIONS</span></a></li>
                {{-- <li>
                    <select id="category" name="category"  class="form-control">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                      </select>
                </li> --}}
                <li><a id="" href="/quemanage"><i class="fa-solid fa-file-circle-question"></i><span>MANAGE QUIZ QUESTIONS</span></a></li>
                <li><a id="" href="/graph"><i class="fa-solid fa-right-from-bracket"></i><span>Statics</span></a></li>
                <li><a id="" href="/quizResult"><i class="fa-solid fa-square-poll-vertical"></i><span>MANAGE QUIZ RESULTS</span></a></li>
                <li><a id="" href="/admin/logout"><i class="fa-solid fa-right-from-bracket"></i><span>LOGOUT</span></a></li>

            </ul>
        </div>
    </section>
    <nav>
    <section id="main-content">
        <header class="main-header">
       <div class="header-left">
        <h4><i class="fa-solid fa-bars"></i><span>&nbsp;Dashboard</span></h4>
       </div>
       
       <div class="header-left">
        {{-- <img src="/assets/img/user.jpg" class="img-responsive"> --}}
    
      
       <a href="/profile" style="padding-left:140px" ><i class="fa fa-user">&nbsp;</i>EDIT PROFILE</a>
       

       </div>
        </header>
    </section>
</nav>
    
  
      {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/19e6f5c2df.js" crossorigin="anonymous"></script>
    
       
  
    </body>
     
        
   

</html> 




