<?php 
session_start();

    require_once('./bd/conf.php');
    $lastId = $_SESSION['user_id'];
    $pdo_query2 = $query->query("SELECT * FROM upload WHERE id_usuario = $lastId") or die($query->error);
    $arquivo = $pdo_query2->fetch(PDO::FETCH_ASSOC)
    ?>
            <script>
            let input = document.getElementById("inputTag");
            let imageName = document.getElementById("imageName")

            input.addEventListener("change", () => {
                let inputImage = document.querySelector("input[type=file]").files[0];

                imageName.innerText = inputImage.name;
            })

            var img = document.getElementById("img1")
            function changeImage(){
                img.setAttribute('src', '<?php echo $arquivo['path']; ?>');
            }
            function changeImage2(){
                img.setAttribute('src', '../assets/imgs/perifl_padrao.png');
            }
