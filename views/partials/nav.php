 <!-- Purpose: Contains the navigation bar for the website. -->


 <nav class="navbar">
     <div class="flex-shrink-0">
         <img class="logo" src="/assets/img/logo.png" alt="Your Company">
     </div>

     <div class="nav-links">

         <a class="<?= urlIs('/') ? 'active' : '' ?>" href="/">
             Home
         </a>

         <a class="<?= urlIs('/instructors') ? 'active' : '' ?>" href="./instructors">
             Trainers
         </a>

         <a class="<?= urlIs('/members') ? 'active' : '' ?>" href="./members">
             Members
         </a>

         <a class="<?= urlIs('/equipment') ? 'active' : '' ?>" href="./equipment">
             Equipments
         </a>
     </div>

 </nav>