<template>
    <div>
    <div id="viewImageModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" :src="'/img/collections/' + img">
            </div>
        </div>
    </div>
</div>
    </div>
</template>
<script>
export default {
    props: ['img']
}
</script>