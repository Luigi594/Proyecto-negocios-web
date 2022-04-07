<h1>Orden Aceptada</h1>
<hr/>
<pre>
{{orderjson}}
</pre>
<fieldset class="row flex-center">
    <button type="submit" id="btnCancelar" class="btn danger">Cancelar</button>
</fieldset>     

<script>
        document.addEventListener("DOMContentLoaded", (e) => {
            document.getElementById("btnCancelar").addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation(); 
                location.assign("index.php?page=mnt.carritos.carritos");
            })
        })
</script>
