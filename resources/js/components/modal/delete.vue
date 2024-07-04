<template>
    <div id="delete_patient" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img
                        src="@/assets/img/sent.png"
                        alt=""
                        width="50"
                        height="46"
                    />
                    <h3>Are you sure want to delete this ?</h3>
                    <div class="m-t-20">
                        <a
                            href="javascript:;"
                            class="btn btn-white"
                            data-bs-dismiss="modal"
                            >Close</a
                        >
                        <button type="submit" class="btn btn-danger ms-1">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
