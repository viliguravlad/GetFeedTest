    /**
    *
    * Updating different "provider_id" fields in the Users table, depending on selected provider.
    *            
    */
    function updateDatabase(provider, provider_id)
    {
        $.post('http://localhost:8000/posts/updateDB', {
             _token: $('meta[name=csrf-token]').attr('content'),
             provider_id: provider_id,
             provider: provider
         }
        )
        .done(function(data) {
            //alert(data);
        })
        .fail(function() {
            //alert( "error" );
        });
    }