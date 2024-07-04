<template>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Social Link Settings</h5>
                </div>
                <div class="card-body pt-0">
                    <form>
                        <div class="settings-form">
                            <div
                                class="links-info"
                                v-for="item in event"
                                :key="item.id"
                            >
                                <div class="row form-row links-cont">
                                    <div
                                        class="input-block form-placeholder d-flex"
                                    >
                                        <button class="btn social-icon">
                                            <i :class="item.icon"></i>
                                        </button>
                                        <input
                                            type="text"
                                            class="form-control"
                                            :placeholder="item.placeholder"
                                        />
                                        <a
                                            href="javascript:;"
                                            class="btn trash"
                                            @click="deleteEvent(event)"
                                        >
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-block text-end">
                            <a
                                href="javascript:void(0);"
                                class="btn add-links"
                                @click="add()"
                            >
                                <i class="fa fa-plus me-1"></i> Add More
                            </a>
                        </div>
                        <div class="input-block mb-0">
                            <div class="settings-btns">
                                <button
                                    type="submit"
                                    class="border-0 btn btn-primary btn-gradient-primary btn-rounded"
                                >
                                    Submit
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-secondary btn-rounded"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const event = [
    {
        id: 1,
        icon: "feather-facebook",
        placeholder: "https://www.facebook.com",
    },
    {
        id: 2,
        icon: "feather-twitter",
        placeholder: "https://www.twitter.com",
    },
    {
        id: 3,
        icon: "feather-youtube",
        placeholder: "https://www.youtube.com",
    },
    {
        id: 4,
        icon: "feather-linkedin",
        placeholder: "https://www.linkedin.com",
    },
];
export default {
    data() {
        return {
            title: "Dashboard-new",
            text: "Settings",
            event,
        };
    },
    methods: {
        deleteEvent: function (event) {
            this.event.splice(this.event.indexOf(event), 1);
        },
        add() {
            this.event.push({
                id: 5,
                icon: "feather-github",
                placeholder: "Social Link",
            });
        },
    },
};
</script>
