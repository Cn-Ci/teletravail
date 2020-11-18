 <div class="container mt-2">
         <table class="table rounded table-dark m-auto">
             <thead>
                 <tr>
                     <th scope="col">no_emp</th>
                     <th scope="col">nom</th>
                     <th scope="col">prenom</th>
                     <th scope="col">emploi</th>
                     <th scope="col">embauche</th>
                     <?php
                     if ($admin) 
                         {
                     ?>
                     <th scope="col">sal</th>
                     <th scope="col">comm</th>
                     <?php
                         }
                     ?>
                     <th scope="col">noserv</th>
                     <th scope="col">sup</th>
                     <th scope="col">noproj</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>  
                     <td><?= $dataSOS['no_emp'] ?></td>
                     <td><?= $dataSOS['nom'] ?></td>
                     <td><?php echo $dataSOS['prenom']; ?></td>
                     <td><?php echo $dataSOS['emploi'] ?></td>
                     <td><?php echo $dataSOS['embauche']; ?></td>
                     <?php
                     if ($admin) 
                         {
                     ?>
                     <td><?php echo $dataSOS['sal']; ?></td>
                     <td><?php echo $dataSOS['comm']; ?></td>
                     <?php
                         }
                     ?>
                     <td><?php echo $dataSOS['noserv']; ?></td>
                     <td><?php echo $dataSOS['sup']; ?></td>
                     <td><?php echo $dataSOS['noproj']; ?></td>
                 </tr>
             </tbody>
         </table> 
     </br>
         <div class="row ">
             <div class="col-12 text-center mb-">
                 <a href='indexEmp.php' class='text-white'>
                     <button id="addBtn" class='col-4 btn btn btn-dark'><i class="fas fa-plus-circle"></i> Retour</button>
                 </a>
             </div>
         </div>    
</div>
