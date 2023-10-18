@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">

<div class="content my-3">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-6">
            <li class="breadcrumb-item"><a href="{{url('listConfirmPayment')}}">All Payments</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['ref']}}</li>
        </ol>
    </nav>
    <h2 id="payment-number">{{$data['ref']}}</h2>
    <hr>

    <!-- start preheader -->
    <div class="preheader" style="
        display: none;
        max-width: 0;
        max-height: 0;
        overflow: hidden;
        font-size: 1px;
        line-height: 1px;
        color: #fff;
        opacity: 0;
      ">
        A preheader is the short summary text that follows the subject line when
        an email is viewed in the inbox.
    </div>
    <!-- end preheader -->

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- start logo -->
        <tr>
            <td align="center" bgcolor="white">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <!-- <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                    <tr>
                        <td align="center" valign="top" style="padding: 36px 24px">
                            <a href="{{url('home')}}" target="_blank" style="display: inline-block">
                                <img src="https://th.bing.com/th/id/OIP.7mLt__Duzbo-CN0xL3JT9gHaHa?pid=ImgDet&rs=1" alt="Logo" border="0" width="48" style="
                      display: block;
                      width: 100px;
                      max-width: 100px;
                      min-width: 100px;
                    " />
                            </a>
                        </td>
                    </tr>
                </table> -->
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end logo -->

        <!-- start hero -->
        <tr>
            <td align="center" bgcolor="white">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="
                  padding: 36px 24px 0;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  border-top: 3px solid #aa0f0a;
                  border-left: 3px solid #aa0f0a;
                  border-right: 3px solid #aa0f0a;
                ">
                            <h1 style="
                    margin: 0;
                    font-size: 32px;
                    font-weight: 700;
                    letter-spacing: -1px;
                    line-height: 48px;
                  ">
                                Barangay South Signal Village
                            </h1>
                            <p style="margin: 0">Online Receipt Copy</p>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end hero -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="white">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="
                  padding: 24px;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  font-size: 16px;
                  line-height: 24px;
                  border-left: 3px solid #aa0f0a;
                  border-right: 3px solid #aa0f0a;
                ">
                            <p style="margin: 0">
                                Attached is a summary of your recent onsite transaction receipt for your records. For official documentation, kindly ensure you receive an official receipt issued by the barangay.
                            </p>
                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start receipt table -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="
                  padding: 24px;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  font-size: 16px;
                  line-height: 24px;
                  border-left: 3px solid #aa0f0a;
                  border-right: 3px solid #aa0f0a;
                ">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="left" bgcolor="#AA0F0A" width="75%" style="
                        padding: 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                        color: white;
                        border-left: 3px solid #aa0f0a;
                  border-right: 3px solid #aa0f0a;
                      ">
                                        <strong>RECEIPT NO. </strong>
                                    </td>
                                    <td align="left" bgcolor="#AA0F0A" width="25%" style="
                        padding: 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                        color: white;
                        border-left: 3px solid #aa0f0a;
                  border-right: 3px solid #aa0f0a;
                      ">
                                        <strong>{{$data['or']}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                     
                      ">
                                        {{$data['document']}} <br />({{$data['type']}}) - <br>
                                        <strong>{{$data['ref']}}</strong>
                                    </td>
                                    <td align="left" width="25%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                       
                      ">
                                        ₱ {{number_format($data['price'], 2, '.', '')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                        
                      ">
                                        <strong> </strong>
                                    </td>
                                    <td align="left" width="25%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      "></td>
                                </tr>

                                @if($data['mop'] != 'ONSITE PAYMENT')
                                <tr>
                                    <td align="left" width="75%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      ">
                                        Online Payment Service Charge:
                                    </td>
                                    <td align="left" width="25%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      ">
                                        ₱ {{number_format($data['service'], 2, '.', '')}}
                                    </td>
                                </tr>

                                @endif
                                <tr>
                                    <td align="left" width="75%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      ">
                                        AMOUNT PAID
                                    </td>
                                    <td align="left" width="25%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      ">
                                        ₱ {{number_format($data['paid'], 2, '.', '')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      ">
                                        <strong> </strong>
                                    </td>
                                    <td align="left" width="25%" style="
                        padding: 6px 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                      "></td>
                                </tr>
                                <tr>
                                    <td align="left" width="75%" style="
                        padding: 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                        border-top: 2px dashed #aa0f0a;
                        border-bottom: 2px dashed #aa0f0a;
                      ">
                                        <strong>CHANGE</strong>
                                    </td>
                                    <td align="left" width="25%" style="
                        padding: 12px;
                        font-family: 'Source Sans Pro', Helvetica, Arial,
                          sans-serif;
                        font-size: 16px;
                        line-height: 24px;
                        border-top: 2px dashed #aa0f0a;
                        border-bottom: 2px dashed #aa0f0a;
                      ">
                                        <strong>₱ {{$data['change']}}</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end reeipt table -->
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end copy block -->

        <!-- start receipt address block -->
        <tr>
            <td align="center" bgcolor="white" valign="top" width="100%">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px
            
            ">
                    <tr>
                        <td align="center" valign="top" style="font-size: 0; border-bottom: 3px solid white;
                border-left: 3px solid #aa0f0a;
                border-bottom: 3px solid #aa0f0a;
                  border-right: 3px solid #aa0f0a;">
                            <!--[if (gte mso 9)|(IE)]>
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
              <tr>
              <td align="left" valign="top" width="300">
              <![endif]-->
                            <div style="
                    display: inline-block;
                    width: 100%;
                    max-width: 50%;
                    min-width: 240px;
                    vertical-align: top;
                  ">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px">
                                    <tr>
                                        <td align="left" valign="top" style="
                          padding-bottom: 36px;
                          padding-left: 36px;
                          font-family: 'Source Sans Pro', Helvetica, Arial,
                            sans-serif;
                          font-size: 16px;
                          line-height: 24px;
                        ">
                                            <p><strong>Payor:</strong></p>
                                            <p>{{$data['name']}}</p>
                                            <p><strong>Mode of Payment:</strong></p>
                                            <p>{{$data['mop']}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!--[if (gte mso 9)|(IE)]>
              </td>
              <td align="left" valign="top" width="300">
              <![endif]-->
                            <div style="
                    display: inline-block;
                    width: 100%;
                    max-width: 50%;
                    min-width: 240px;
                    vertical-align: top;
                  ">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px">
                                    <tr>
                                        <td align="left" valign="top" style="
                          padding-bottom: 36px;
                          padding-left: 36px;
                          font-family: 'Source Sans Pro', Helvetica, Arial,
                            sans-serif;
                          font-size: 16px;
                          line-height: 24px;
                        ">
                                            <p><strong>Processed by:</strong></p>
                                            <p>{{$data['process']}}</p>
                                            <p><strong>Paid on:</strong></p>
                                            <p>{{$data['date']}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!--[if (gte mso 9)|(IE)]>
              </td>
              </tr>
              </table>
              <![endif]-->
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end receipt address block -->

        <!-- start footer -->
        <tr>
            <td align="center" bgcolor="white" style="padding: 24px">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->

                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end footer -->
    </table>
    <!-- end body -->

</div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<style>
    .hide-column {
        display: none;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>


</html>