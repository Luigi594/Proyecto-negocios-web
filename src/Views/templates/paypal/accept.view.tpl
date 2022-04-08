<h1>Orden Aceptada</h1>
<hr/>
<fieldset class="row flex-center">
    <div class="col-xs-12 mt-5 mb-3">
        <div class="center-block">
            <button type="submit" id="btnCancelar" class="btn primary">Regresar</button>
        </div> 
    </div>
</fieldset> 

<pre>
{{orderjson}}
</pre>

<script>
    document.addEventListener("DOMContentLoaded", (e) => {
        document.getElementById("btnCancelar").addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation(); 
            location.assign("index.php?page=mnt.catalogos.catalogos");
        })
    })
</script>
