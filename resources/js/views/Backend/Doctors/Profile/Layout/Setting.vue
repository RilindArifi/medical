<template>
    <div class="setting-form-blk">
        <form>
            <div class="row">
                <div class="col-12">
                    <div class="form-heading">
                        <h4>Account Setting</h4>
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="input-block local-forms">
                        <label>Username </label>
                        <input
                            class="form-control"
                            type="text"
                            value="brucewillis@29"
                        />
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="input-block local-forms">
                        <label>Mobile </label>
                        <input
                            class="form-control"
                            type="text"
                            value="+1 23 456890"
                        />
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="input-block local-forms">
                        <label>Email </label>
                        <input
                            class="form-control"
                            type="email"
                            value="brucewillis@info.com"
                        />
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="input-block local-forms">
                        <label
                            >Address <span class="login-danger">*</span></label
                        >
                        <textarea class="form-control" rows="3" cols="30">
101, Elanxa Apartments, 340 N Madison Avenue</textarea
                        >
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-heading">
                    <h4>Security Setting</h4>
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="input-block local-forms">
                    <label>Current Password </label>
                    <input class="form-control" type="password" value="12345" />
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="input-block local-forms">
                    <label>New Password </label>
                    <input
                        class="form-control"
                        type="password"
                        placeholder=""
                    />
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="input-block local-forms">
                    <label>Confirm Password </label>
                    <input
                        class="form-control"
                        type="password"
                        placeholder=""
                    />
                </div>
            </div>
            <div class="col-12 col-sm-12">
                <div class="profile-check-blk input-block">
                    <div class="remember-me">
                        <label
                            class="custom_check mr-2 mb-0 d-inline-flex remember-me"
                        >
                            Profile Visibility For Everyone
                            <input type="checkbox" name="radio" checked />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="remember-me">
                        <label
                            class="custom_check mr-2 mb-0 d-inline-flex remember-me"
                        >
                            New task notifications
                            <input type="checkbox" name="radio" checked />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="remember-me">
                        <label
                            class="custom_check mr-2 mb-0 d-inline-flex remember-me"
                        >
                            New friend request notifications
                            <input type="checkbox" name="radio" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="doctor-submit">
                    <button
                        type="submit"
                        class="btn btn-primary submit-form me-2"
                    >
                        Submit
                    </button>
                    <button type="submit" class="btn btn-primary cancel-form">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup></script>
