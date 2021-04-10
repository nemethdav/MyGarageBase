<template>
    <div class="col-lg-7 col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h3 class="card-title d-flex justify-content-between">
                        Járműveim
                        <button type="button" rel="tooltip" title="Új jármű hozzáadása"
                                class="btn btn-success btn-link btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                </h3>

            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning text-center">
                    <th width="5%">ID</th>
                    <th width="">Rendszám</th>
                    <th width="">Márka-Típus</th>
                    <th width="">Hengerűrtartalom</th>
                    <th width="">Teljesítmény (LE)</th>
                    <th width="25%">Műveletek</th>
                    </thead>
                    <tbody class="text-center">
                    <tr>
                        <td>1</td>
                        <td>AAA-123</td>
                        <td>Honda</td>
                        <td>CBR 500R</td>
                        <td>48 LE</td>
                        <td>
                            <button type="button" rel="tooltip" title="Részletek"
                                    class="btn btn-success btn-link btn-sm">
                                <i class="material-icons">launch</i>
                            </button>
                            <button type="button" rel="tooltip" title="Szerkesztés"
                                    class="btn btn-warning btn-link btn-sm">
                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" title="Törlés"
                                    class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'VehiclesTable',
}
</script>
