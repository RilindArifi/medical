<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb :title="title" :text="text" path="invoices" />
      <!-- /Page Header -->

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-12">
                    <div class="form-heading">
                      <h4>Add Invoice</h4>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Patient Name <span class="login-danger">*</span></label>
                      <input class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Email <span class="login-danger">*</span></label>
                      <input class="form-control" type="email" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Department <span class="login-danger">*</span></label>
                      <vue-select
                        :options="Orthopedics"
                        id="orthopedics"
                        placeholder="Select Department"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Tax <span class="login-danger">*</span></label>
                      <vue-select :options="Tax" id="tax" placeholder="Select Tax" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms cal-icon">
                      <label>Invoice Date <span class="login-danger">*</span></label>
                      <datepicker
                        v-model="startdate"
                        :input-format="dateFormat"
                        class="form-control datetimepicker"
                        :editable="true"
                        :clearable="false"
                        placeholder=""
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms cal-icon">
                      <label>Due Date <span class="login-danger">*</span></label>
                      <datepicker
                        v-model="startdateOne"
                        :input-format="dateFormat"
                        class="form-control datetimepicker"
                        :editable="true"
                        :clearable="false"
                        placeholder=""
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Patient Address <span class="login-danger">*</span></label>
                      <textarea class="form-control" rows="3" cols="30"></textarea>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Billing Address <span class="login-danger">*</span></label>
                      <textarea class="form-control" rows="3" cols="30"></textarea>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Payment Method <span class="login-danger">*</span></label>
                      <vue-select
                        :options="Payment"
                        id="payment"
                        placeholder="Select Payment Method"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Select Payment Status <span class="login-danger">*</span></label>
                      <vue-select :options="Paid" id="paid" placeholder="Select Tax" />
                    </div>
                  </div>
                  <div class="col-12 col-sm-12">
                    <div class="table-responsive">
                      <table class="table border-0 custom-table invoices-table">
                        <thead>
                          <tr>
                            <th style="width: 20px">#</th>
                            <th class="col-sm-2">Item</th>
                            <th class="col-md-6">Description</th>
                            <th style="width: 100px">Unit Cost</th>
                            <th style="width: 80px">Qty</th>
                            <th>Amount</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>
                              <input class="form-control" type="text" style="min-width: 150px" />
                            </td>
                            <td>
                              <input class="form-control" type="text" style="min-width: 150px" />
                            </td>
                            <td>
                              <input class="form-control" style="width: 100px" type="text" />
                            </td>
                            <td>
                              <input class="form-control" style="width: 80px" type="text" />
                            </td>
                            <td>
                              <input class="form-control" style="width: 120px" type="text" />
                            </td>
                            <td>
                              <a
                                href="javascript:void(0)"
                                class="text-success font-18 add-table-invoice"
                                title="Add"
                                ><i class="fa fa-plus"></i
                              ></a>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>
                              <input class="form-control" type="text" style="min-width: 150px" />
                            </td>
                            <td>
                              <input class="form-control" type="text" style="min-width: 150px" />
                            </td>
                            <td>
                              <input class="form-control" style="width: 100px" type="text" />
                            </td>
                            <td>
                              <input class="form-control" style="width: 80px" type="text" />
                            </td>
                            <td>
                              <input class="form-control" style="width: 120px" type="text" />
                            </td>
                            <td>
                              <a
                                href="javascript:void(0)"
                                class="text-success font-18 add-table-invoice"
                                title="Add"
                                ><i class="fa fa-plus"></i
                              ></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="table-responsive custom-table invoices-table">
                      <table class="table border-0 grand-totals">
                        <tbody>
                          <tr>
                            <td class="text-end">Total</td>
                            <td>
                              <input class="form-control text-end" type="text" />
                            </td>
                          </tr>
                          <tr>
                            <td class="text-end">Tax</td>
                            <td>
                              <input class="form-control text-end" type="text" />
                            </td>
                          </tr>
                          <tr class="bold-total">
                            <td class="text-end">Grand Total</td>
                            <td>
                              <input class="form-control text-end" type="text" />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-block local-forms">
                      <label>Other Information <span class="login-danger">*</span></label>
                      <textarea class="form-control" rows="3" cols="30"></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="doctor-submit text-end">
                      <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                      <button type="submit" class="btn btn-primary cancel-form">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
const currentDate = ref(new Date())
const currentDateOne = ref(new Date())
export default {
  data() {
    return {
      title: 'Accounts',
      text: 'Add Invoices',
      startdate: currentDate,
      startdateOne: currentDateOne,
      dateFormat: 'dd-MM-yyyy',
      Orthopedics: ['Select Department', 'Orthopedics', 'Radiology', 'Dentist'],
      Tax: ['Select Tax', 'VAT', 'GST', 'No GST'],
      Payment: ['Select Payment Method', 'Debit Card', 'Gpay'],
      Paid: ['Select Tax', 'Paid', 'Un Paid', 'Patially Paid']
    }
  }
}
</script>
