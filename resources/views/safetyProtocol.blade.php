<html lang="en">
<!--HEADER -->
@include('head')
<style>
    .my-container-header {
        text-align: center;
        margin: 2em;
    }

    .my-container {
        margin: 2em;
        border-radius: 10px;
        border: 4px solid #AA0F0A;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table td {
        border: 10px solid white;
        background-color: #D3d3d3;
        text-align: center;
    }

    .table th {
        text-align: center;
    }

    thead {
        background-color: #AA0F0A;
        color: white;
        text-align: center;
        border: 10px solid #AA0F0A;
    }

    tbody {
        border: white;
        text-align: center;

    }


    .ready-mark {
        color: #198754;
        font-weight: bolder;
        background-color: #D3d3d3;
    }

    .get-set-mark {
        color: #ffc107;
        font-weight: bolder;
        background-color: #D3d3d3;
    }

    .go-mark {
        color: #dc3545;
        font-weight: bolder;
        background-color: #D3d3d3;
    }

    .calamity {
        color: #AA0F0A;
        font-size: 125%;
        font-weight: bolder;
    }

    .table-font {
        font-weight: bolder;
        background-color: #D3d3d3;

    }


    @media(max-width: 950px) {
        .table thead {
            display: none;
        }

        .table,
        .table tbody,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
        }

        .table td {
            text-align: right;
            padding-left: 50%;
            text-align: right;
            position: relative;
            font-size: 15px;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-size: 15px;
            text-align: left;
            font-weight: bold;
        }
    }
</style>
<!-- SAFETY SECTION -->
<!-- SAFETY SECTION -->
<div class="my-container-header">
            <h1>EARLY WARNING SYSTEM</h1>
        </div>
<div class="my-container">
    <div class="mb-2 mt-2" style="display: block;">
        <table class="table">
            <thead>
                <th>CALAMITY/EWS</th>
                <th>MARKA (MARK)</th>
                <th>BAHA (FLOOD)</th>
                <th>LINDOL (EARTHQUAKE)</th>
                <th>SUNOG (FIRE)</th>
                <th>BAGYO (TYPHOON)</th>
            </thead>
            <tbody>
                <tr>
                    <td class="calamity pt-4" data-label="CALAMITY/EWS">SIREN</td>
                    <td data-label="MARKA (MARK)">
                        <div class="vstack gap-1">
                            <div class="ready-mark">READY</div>
                            <div class="get-set-mark">GET SET</div>
                            <div class="go-mark">GO</div>
                        </div>
                    </td>
                    <td data-label="BAHA (FLOOD)">
                        <div class="vstack gap-1">
                            <div class="table-font">6 METERS</div>
                            <div class="table-font">6-S -12 INCHES SIREN</div>
                            <div class="table-font">60 - 24 IN (M.P)</div>
                        </div>
                    </td>
                    <td data-label="LINDOL (EARTHQUAKE)">
                        <div class="vstack gap-1">
                            <div class="table-font">INTENSITY 3-5</div>
                            <div class="table-font">INTENSITY 5-10</div>
                            <div class="table-font">INTENSITY 10-15</div>
                        </div>
                    </td>
                    <td data-label="SUNOG (FIRE)">
                        <div class="vstack gap-1">
                            <div class="table-font">SMOKE</div>
                            <div class="table-font">FIRE - SIREN</div>
                            <div class="table-font">FIRE & SMOKE</div>
                        </div>
                    </td>
                    <td data-label="BAGYO (TYPHOON)">
                        <div class="vstack gap-1">
                            <div class="table-font">SIGNAL 1-2</div>
                            <div class="table-font">SIGNAL 2-3</div>
                            <div class="table-font">SIGNAL 3-4</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="calamity pt-4" data-label="CALAMITY/EWS">PUBLIC ADDRESS</td>
                    <td data-label="MARKA (MARK)">
                        <div class="vstack gap-1">
                            <div class="ready-mark">READY</div>
                            <div class="get-set-mark">GET SET</div>
                            <div class="go-mark">GO</div>
                        </div>
                    </td>
                    <td data-label="BAHA (FLOOD)">
                        <div class="vstack gap-1">
                            <div class="table-font">AFTER</div>
                            <div class="table-font">SIREN</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="LINDOL (EARTHQUAKE)">
                        <div class="vstack gap-1">
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="SUNOG (FIRE)">
                        <div class="vstack gap-1">
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="BAGYO (TYPHOON)">
                        <div class="vstack gap-1">
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="calamity pt-4" data-label="CALAMITY/EWS">TEXT BRIGRADE</td>
                    <td data-label="MARKA (MARK)">
                        <div class="vstack gap-1">
                            <div class="ready-mark">READY</div>
                            <div class="get-set-mark">GET SET</div>
                            <div class="go-mark">GO</div>
                        </div>
                    </td>
                    <td data-label="BAHA (FLOOD)">
                        <div class="vstack gap-1">
                            <div class="table-font">AFTER</div>
                            <div class="table-font">P.A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="LINDOL (EARTHQUAKE)">
                        <div class="vstack gap-1">
                            <div class="table-font">AFTER</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="SUNOG (FIRE)">
                        <div class="vstack gap-1">
                            <div class="table-font">AFTER</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="BAGYO (TYPHOON)">
                        <div class="vstack gap-1">
                            <div class="table-font">AFTER</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="calamity pt-4" data-label="CALAMITY/EWS">BARANGAY ROVING TEAM</td>
                    <td data-label="MARKA (MARK)">
                        <div class="vstack gap-1">
                            <div class="ready-mark">READY</div>
                            <div class="get-set-mark">GET SET</div>
                            <div class="go-mark">GO</div>
                        </div>
                    </td>
                    <td data-label="BAHA (FLOOD)">
                        <div class="vstack gap-1">
                            <div class="table-font">N/A</div>
                            <div class="table-font"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg></div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="LINDOL (EARTHQUAKE)">
                        <div class="vstack gap-1">
                            <div class="table-font">N/A</div>
                            <div class="table-font"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg></div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="SUNOG (FIRE)">
                        <div class="vstack gap-1">
                            <div class="table-font">SMOKE</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                    <td data-label="BAGYO (TYPHOON)">
                        <div class="vstack gap-1">
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                            <div class="table-font">N/A</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="calamity pt-4" data-label="CALAMITY/EWS">EVACUATION AREA</td>
                    <td class="table-font pt-2" style="font-size: 400%; color: #AA0F0A;" data-label="MARKA (MARK)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </td>
                    <td class="calamity pt-4" data-label="BAHA (FLOOD)">
                        CARDONES SCHOOL
                    </td>
                    <td class="calamity pt-3" data-label="LINDOL (EARTHQUAKE)">
                        TANYAG ST./ NAVY RD.<br>
                        (VILLAMOR-AIR BASE)
                    </td>
                    <td class="calamity pt-3" data-label="SUNOG (FIRE)">
                        MAGSAYSAY<br>COVERED COURT
                    </td>
                    <td class="calamity pt-3" data-label="BAGYO (TYPHOON)">
                        MAGSAYSAY<br>COVERED COURT
                    </td>
                </tr>
                <tr>
                    <td class="calamity pt-3" data-label="CALAMITY/EWS">FREQUENCY</td>
                    <td class="calamity pt-3" data-label="MARKA (MARK)">SIREN</td>
                    <td class="calamity pt-3" data-label="BAHA (FLOOD)">3x 15 MINUTES</td>
                    <td class="calamity pt-3" data-label="LINDOL (EARTHQUAKE)">1x 45 SECONDS - 1 MINUTE</td>
                    <td class="calamity pt-3" data-label="SUNOG (FIRE)">1x 15 SECONDS</td>
                    <td class="calamity pt-3" data-label="BAGYO (TYPHOON)">2x</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>



<script>
    function showImage(imgElement) {
        // create a new element to show the image
        var newImg = document.createElement("img");
        newImg.src = imgElement.src;

        // set the CSS style for the new element
        newImg.style.position = "fixed";
        newImg.style.top = 0;
        newImg.style.left = 0;
        newImg.style.width = "100%";
        newImg.style.height = "100%";
        newImg.style.objectFit = "contain";
        newImg.style.zIndex = 9999;
        newImg.style.backgroundColor = "rgba(0,0,0,0.8)";

        // add the new element to the document
        document.body.appendChild(newImg);

        // add an event listener to remove the new element when it is clicked
        newImg.addEventListener("click", function() {
            document.body.removeChild(newImg);
        });
    }
</script>



<!-- FOOTER-->
@include('footer')