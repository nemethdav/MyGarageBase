<template>
    <div class="col-lg-5 col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">
                    Jármű neve
                </h4>

            </div>
            <div class="card-body text-center">
                <form action="">
                    <img :src="require('/storage/imgs/vehicles/default.png').default" width="100" alt="Jármű kép"
                         class="mb-3"><br>
                    <label for="vehicle_image">Jármű profilkép megváltoztatása</label><br>
                    <input type="file" id="vehicle_image" name="vehicle_image" accept="image/*">

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="vehicleNickName">Becenév</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="vehicleNickName" id="vehicleNickName"
                                       placeholder="Jármű beceneve"/>
                            </div>
                        </div>
                    </div>

                    <select class="custom-select">
                        <option selected>Jármű fajtája</option>
                        <option value="1">Motorkerékpár</option>
                        <option value="2">Személyautó</option>
                    </select>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="manufacturer">Gyártmány</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="manufacturer" id="manufacturer"
                                       placeholder="Jármű gyártója" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="type">Típus</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="type" id="type"
                                       placeholder="Jármű típusa" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="license_plate_number">Forgalmi rendszám</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="license_plate_number"
                                       id="license_plate_number"
                                       placeholder="Jármű forgalmi rendszáma"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="year_of_manufacture">Gyártási év</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="number" class="form-control" name="year_of_manufacture"
                                       id="year_of_manufacture"
                                       placeholder="Jármű gyártási éve" min="1900" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="chassis_number">Alvázszám</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="chassis_number" id="chassis_number"
                                       placeholder="Jármű alvázszáma"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="motor_number">Motorszám</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="motor_number" id="motor_number"
                                       placeholder="Jármű motorszáma"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="motor_code">Motorkód</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="motor_code" id="motor_code"
                                       placeholder="Jármű motorkódja"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="cylinder_capacity">Hengerűrtartalom</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="number" class="form-control" name="cylinder_capacity" id="cylinder_capacity"
                                       placeholder="Jármű hengerűrtartalma" min="0" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="performance_kw">Teljesítmény (kW)</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="number" class="form-control" name="performance_kw" id="performance_kw"
                                       placeholder="Jármű teljesítménye kW-ban megadva" min="0" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="performance_le">Teljesítmény (LE)</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="number" class="form-control" name="performance_le" id="performance_le"
                                       placeholder="Jármű teljesítménye LE-ben megadva" min="0" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="validity_of_technical_Examination">Műszaki vizsga érvényessége</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="date" class="form-control" name="validity_of_technical_Examination" id="validity_of_technical_Examination"
                                       placeholder="Műszaki vizsga érvényessége" min="1900-01-01"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="date_of_purchase">Vásárlás dátuma</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_of_purchase" id="date_of_purchase"
                                       placeholder="Jármű eladásának dátuma" min="1900-01-01"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="date_of_sale">Eladás dátuma</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_of_sale" id="date_of_sale"
                                       placeholder="Jármű eladásának dátuma" min="1900-01-01"/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-warning">Mentés</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AddVehicle',
    data() {

    },
    methods: {}
}
</script>
