<?php 
include_once 'header.php';

if (isset($_SESSION['u_id'])):
    
    include_once 'includes/dbh.inc.php';
    include_once 'includes/func.inc.php';
    
    $u_id = $_SESSION['u_id'];
    $sql = "SELECT * 
    FROM citationContexts 
    WHERE id = (SELECT cc_id 
                FROM shuffleCitationContexts 
                WHERE id NOT IN (SELECT scc_id 
                                FROM taglogs 
                                WHERE user_id = $u_id 
                                UNION 
                                SELECT scc_id 
                                FROM taglogs 
                                GROUP BY scc_id 
                                HAVING count(user_id) >= 3 
                                UNION 
                                SELECT scc_id 
                                FROM skips 
                                WHERE user_id = $u_id) 
                ORDER BY id LIMIT 1)";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $citation_id = $row['citation_id'];
    $context = $row['context'];
    $context = allHighlight($context);


?>
<div class="body">

    <div class = "container ">
        <h1 class="topic">Citation Context</h1>
        <div class="sub-topic size20">Context:</div><div class = "context size20"><?php echo $context ?></div>
        <div class ="seemore">
            <div id="myDiv" style="display:none;" class="answer_list" >
                <div class="inline border"><b>Citation Context ID:</b><div class = "id"><?php echo $id ?></div></div>
                <div class="detail">
                    <div class="left-detail col-5 border">
                        <b>Citing paper</b>
                        <hr>
                        <div class="inline"><b>Title of paper:</b> <div class="title2"></div></div>
                        <div class="inline"><b>year of paper:</b> <div class="year2"></div></div>
                        <div class="inline"><b>abstract:</b> <div class="abstract"></div></div>
                        
                    </div>
                    <div class="col-2 border">
                        Cites <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="right-detail col-5 border">
                        <b>Cited paper</b>
                        <hr>
                        <div class="inline"><b>Citation ID: </b> <div class = "citation_id"><?php echo $citation_id ?></div></div>
                        <div class="inline"><b>Title of citation:</b> <div class="title"></div></div>
                        <div class="inline"><b>Year of citation:</b> <div class="year"></div></div>
                        <div class="inline"><b>Author of citation:</b> <div class="author"></div></div>
                    </div>
                </div>  
            </div>
            <button id ="myButton" class="btn btn-success" type="button" name="answer">See more</button>
        </div>
        <form class="type-form">
            <div class="sub-topic">From this citation context, how does this paper utilize the algorithm(s) in <span style="background:lightblue;"><b class="out"></b></span>?</div>
            <label class="size20"><input type="checkbox" value="1" name="type" > use</label>
            <label class="size20"><input type="checkbox" value="2" name="type"> extend</label>
            <label class="size20"><input type="checkbox" value="3" name="type" > mention</label>
            <label class="size16"><input type="checkbox" value="4" name="type" > <span style="background:lightblue;"><b class="out2"></b></span> is not a citation or does not propose any algorithms</label>
            <br>
            <div class="space-between">
                <button type="button" id ="tagbutton" class="btn btn-primary" >Submit</button>
                <button type="button" id ="skip" class="btn btn-secondary" >Skip</button>
            </div>
            
        </form>
        <a href="Labeling-Instruction.v3.pdf" target="_blank">See Labeling Instructions</a>
            
    </div>


</div>


<script>
    var context = $(".context").html()
    var res = context.match(/=-=.*-=-/);
    $(".out").html(res);

    var context = $(".context").html()
    var res = context.match(/=-=.*-=-/);
    $(".out2").html(res);


    if(id = $(".id").text() == "") {
        alert("you did all citation context");
        window.location.replace("index.php");
    }
     
    $("#skip").click( function(){
        
        var cc_id = $(".id").text();

        $.post("includes/helper3.inc.php",{
        u_id : <?php echo "$u_id"?>,
        cc_id : cc_id
        },
        function(data, status){
            data = JSON.parse(data);
            console.log(data.id);
            if(data.id == null) {
                alert("you did all citation context");
                window.location.replace("index.php");
            }else{
                $(".id").html(data.id);
                $(".citation_id").html(data.citation_id);
                $(".context").html(data.context);
                $('input[name="type"]:checked').prop('checked', false); 
                $('#myDiv').hide();
                var context = $(".context").html()
                var res = context.match(/=-=.*-=-/);
                $(".out").html(res);

                var context = $(".context").html()
                var res = context.match(/=-=.*-=-/);
                $(".out2").html(res);
                
            }
        });
        
        
    });
    $("#tagbutton").click( function(){
        
        var type =  $('input[name="type"]:checked').val();
        var citation_id = $(".citation_id").text();
        var id = $(".id").text();
        console.log(type+citation_id+id);
        if(type == null) alert("Please choose a type of this citation context");
        else {
            $.post("includes/helper.inc.php",{
            u_id : <?php echo "$u_id"?>,
            id : id,
            citation_id : citation_id,
            type : type
            },
            function(data, status){
                data = JSON.parse(data);
                console.log(data.id);
                if(data.id == null) {
                    
                    alert("you did all citation context");
                    window.location.replace("index.php");
                }else{
                    $(".id").html(data.id);
                    $(".citation_id").html(data.citation_id);
                    $(".context").html(data.context);
                    $('input[name="type"]:checked').prop('checked', false); 
                    $('#myDiv').hide();
                    var context = $(".context").html()
                    var res = context.match(/=-=.*-=-/);
                    $(".out").html(res);

                    var context = $(".context").html()
                    var res = context.match(/=-=.*-=-/);
                    $(".out2").html(res);
                }
            });
        }
        
    });
    // click only one block
    $("input:checkbox").on('click', function() {
    var $box = $(this);
    if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }});

    $('#myButton').click(function() {
        $('#myDiv').toggle('fast');
        
        var citation_id = $(".citation_id").html();
        $.post("includes/helper2.inc.php",{
            citation_id : citation_id,
            },
            function(data, status){
    
                data = JSON.parse(data);
                console.log(data.id);
                if(data.title == null) $(".title").html("Unknown");
                else $(".title").html(data.title);   

                if(data.author == null) $(".author").html("Unknown");
                else $(".author").html(data.author);

                if(data.year == null) $(".year").html("Unknown");
                else $(".year").html(data.year);
                
                if(data.title2 == null) $(".title2").html("Unknown");
                else $(".title2").html(data.title2);   

                if(data.year2 == null) $(".year2").html("Unknown");
                else $(".year2").html(data.year2);

                if(data.abstract == null) $(".abstract").html("Unknown");
                else $(".abstract").html(data.abstract);
                    
                    
                    
            });
    });
</script>
<?php else :
    header("Location: ./index.php")
; endif;?>

<?php include_once 'footer.php'?>