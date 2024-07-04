<template>
    <div id="incoming_call" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="crypto-income-blk text-center">
                        <div class="voice-call-user">
                            <img
                                src="@/assets/img/profiles/avatar-01.jpg"
                                alt="img"
                            />
                            <h3>Bernardo James</h3>
                            <p>Senior Developer</p>
                        </div>
                        <div class="calling-income">
                            <h4>Calling...</h4>
                        </div>
                        <div class="voice-menu-income comman-flex">
                            <a
                                href="javascript:;"
                                class="btn btn-primary call-remove comman-flex me-2"
                                data-bs-dismiss="modal"
                                ><img
                                    src="@/assets/img/icons/call-remove.svg"
                                    alt="img"
                            /></a>
                            <a
                                href="javascript:;"
                                class="btn btn-primary call-received comman-flex"
                                ><img
                                    src="@/assets/img/icons/call-received.svg"
                                    alt="img"
                            /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
