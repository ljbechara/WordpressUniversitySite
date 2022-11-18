import $ from 'jquery';

class MyNotes{
    constructor(){
       this.events();
    }

    events(){
        $('.delete-note').on("click", this.deleteNote );
    }

    // Methods will go here

    deleteNote(){
        $.ajax({
            url: universityData.root_url + '/wp-json/wp/v2/note/108',
            type: 'DELETE',
            success: () => {
                console.log("Congrats");
                console.log(response);
            },
            error: () =>{
                console.log("Sorry");
                console.log(response);
            }
        });
    }
}

export default MyNotes;