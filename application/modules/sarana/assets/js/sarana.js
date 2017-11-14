$(document).ready(function() {
    $(".krit_input").on("change", function() {
        $this = $(this);
        //idHitung = $this.attr('inputval');
        persen = $this.val();
        if(persen > 70){
            bobot = 50
        } else if(persen > 50) {
            bobot = 30
        } else if(persen > 0){
            bobot = 20
        } else {
            bobot = 0
        }
        
        $this.next("span.sarana_bobot").html("Besar bobot: <strong>" + bobot + "</strong>");
        console.log($this.next("span.sarana_bobot"));
    })
    $(".btn-hitung").click(function() {
        $this = $(this);
        idHitung = $this.attr('inputval');
        persen = $("#"+idHitung).val();
        if(persen > 70){
            bobot = 50
        } else if(persen > 50) {
            bobot = 30
        } else if(persen > 0){
            bobot = 20
        } else {
            bobot = 0
        }
        $("#"+idHitung+"_bobot").html("Besar bobot: <strong>" + bobot + "</strong>");
    });
});
