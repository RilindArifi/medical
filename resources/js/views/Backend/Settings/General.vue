<template>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Website Basic Details</h5>
                </div>
                <div class="card-body pt-0">
                    <form>
                        <div class="settings-form">
                            <div class="input-block">
                                <label
                                    >Website Name
                                    <span class="star-red">*</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Website Name"
                                />
                            </div>
                            <div class="input-block">
                                <p class="settings-label">
                                    Logo <span class="star-red">*</span>
                                </p>
                                <div class="settings-btn">
                                    <input
                                        type="file"
                                        accept="image/*"
                                        name="image"
                                        id="file"
                                        onchange="loadFile(event)"
                                        class="hide-input"
                                    />
                                    <label for="file" class="upload">
                                        <i class="feather-upload"></i>
                                    </label>
                                </div>
                                <h6 class="settings-size">
                                    Recommended image size is
                                    <span>150px x 150px</span>
                                </h6>
                                <div class="upload-images">
                                    <img
                                        src="@/assets/img/logo-dark.png"
                                        alt="Image"
                                    />
                                    <a
                                        href="javascript:void(0);"
                                        class="btn-icon logo-hide-btn"
                                    >
                                        <i class="feather-x-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="input-block">
                                <p class="settings-label">
                                    Favicon <span class="star-red">*</span>
                                </p>
                                <div class="settings-btn">
                                    <input
                                        type="file"
                                        accept="image/*"
                                        name="image"
                                        id="files"
                                        onchange="loadFile(event)"
                                        class="hide-input"
                                    />
                                    <label for="file" class="upload">
                                        <i class="feather-upload"></i>
                                    </label>
                                </div>
                                <h6 class="settings-size">
                                    Recommended image size is
                                    <span>16px x 16px or 32px x 32px</span>
                                </h6>
                                <h6 class="settings-size mt-1">
                                    Accepted formats: only png and ico
                                </h6>
                                <div class="upload-images upload-size">
                                    <img
                                        src="@/assets/img/favicon.png"
                                        alt="Image"
                                    />
                                    <a
                                        href="javascript:void(0);"
                                        class="btn-icon logo-hide-btn"
                                    >
                                        <i class="feather-x-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="input-block">
                                        <div
                                            class="status-toggle d-flex justify-content-between align-items-center"
                                        >
                                            <p class="mb-0">RTL</p>
                                            <input
                                                type="checkbox"
                                                id="status_1"
                                                class="check"
                                            />
                                            <label
                                                for="status_1"
                                                class="checktoggle"
                                                >checkbox</label
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-0">
                                <div class="settings-btns">
                                    <button
                                        type="submit"
                                        class="border-0 btn btn-primary btn-gradient-primary btn-rounded"
                                    >
                                        Update</button
                                    >&nbsp;&nbsp;
                                    <button
                                        type="submit"
                                        class="btn btn-secondary btn-rounded"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Address Details</h5>
                </div>
                <div class="card-body pt-0">
                    <form>
                        <div class="settings-form">
                            <div class="input-block">
                                <label
                                    >Address Line 1
                                    <span class="star-red">*</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Address Line 1"
                                />
                            </div>
                            <div class="input-block">
                                <label
                                    >Address Line 2
                                    <span class="star-red">*</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Address Line 2"
                                />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-block">
                                        <label
                                            >City
                                            <span class="star-red"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block">
                                        <label
                                            >State/Province
                                            <span class="star-red"
                                                >*</span
                                            ></label
                                        >
                                        <vue-select
                                            :options="SettingCity"
                                            id="settingCity"
                                            placeholder="Select"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block">
                                        <label
                                            >Zip/Postal Code
                                            <span class="star-red"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block">
                                        <label
                                            >Country
                                            <span class="star-red"
                                                >*</span
                                            ></label
                                        >
                                        <vue-select
                                            :options="SettingCountry"
                                            id="settingcuntry"
                                            placeholder="Select"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-0">
                                <div class="settings-btns">
                                    <button
                                        type="submit"
                                        class="border-0 btn btn-primary btn-gradient-primary btn-rounded"
                                    >
                                        Update</button
                                    >&nbsp;&nbsp;
                                    <button
                                        type="submit"
                                        class="btn btn-secondary btn-rounded"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            title: "Dashboard-new",
            text: "Settings",
            SettingCity: ["California", "Tasmania", "Auckland", "Marlborough"],
            SettingCountry: ["India", "London", "France", "USA"],
        };
    },
};
</script>
