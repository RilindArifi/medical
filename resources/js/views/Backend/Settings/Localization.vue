<template>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Localization Details</h5>
            </div>
            <div class="card-body pt-0">
              <form>
                <div class="settings-form">
                  <div class="input-block">
                    <label>Time Zone</label>
                    <vue-select
                      :options="SettingTime"
                      id="settingtime"
                      placeholder="(UTC +5:30) Antarctica/Palmer"
                    />
                  </div>
                  <div class="input-block">
                    <label>Date Format</label>
                    <vue-select :options="SettingDate" id="settingdate" placeholder="15 May 2016" />
                  </div>
                  <div class="input-block">
                    <label>Time Format</label>
                    <vue-select
                      :options="SettingTimeFormat"
                      id="settingtimeformat"
                      placeholder="12 Hours"
                    />
                  </div>
                  <div class="input-block">
                    <label>Currency Symbol</label>
                    <vue-select :options="SettingCurrency" id="settingcurrency" placeholder="$" />
                  </div>
                  <div class="input-block mb-0">
                    <div class="settings-btns">
                      <button
                        type="submit"
                        class="border-0 btn btn-primary btn-gradient-primary btn-rounded"
                      >
                        Update
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
      title: 'Dashboard-new',
      text: 'Settings',
      SettingTime: ['(UTC +5:30) Antarctica/Palmer', '(UTC+05:30) India'],
      SettingCurrency: [, '$', '₹', '£', '€'],
      SettingTimeFormat: ['12 Hours', '24 Hours', '36 Hours', '48 Hours', '60 Hours'],
      SettingDate: [
        '15 May 2016',
        '15/05/2016',
        '15.05.2016',
        '15-05-2016',
        '05/15/2016',
        '2016/05/15',
        '2016-05-15'
      ]
    }
  }
}
</script>
