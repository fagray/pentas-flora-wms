<template>
<div>
    <div style="margin-top:90px;"></div>
<div  class="fixed-bottom">
        <div class="bottom-menu">
            <div class="row justify-content-center">
            <a :href="previousUrl" class="btn btn-default" >CANCEL</a>
            <input :disabled="disable" class="btn btn-primary" type="submit" value="SAVE">
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['disable','previousUrl'],
    mounted() {
        
    }
}
</script>
