<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='{{ asset("backend/print/print.css") }}'>
    <script src='{{ asset("backend/print/jquery.min.js") }}'></script>
    <script src='{{ asset("backend/print/jQuery.print.min.js") }}'></script>
    <script>
		$("#handlePrint").click(function (){
			$("#print").print();
		});
	</script>
	
</head>

<body>
    <button type="button" id="handlePrint">Print this page</button>

    <div class="container" id="print">
        <header class="text-center">
            <img src="{{ asset('images/rsc.png') }}" style="height: 54px;" alt="">
            <h3>Laptop Policy Acceptance Form</h3>
        </header>
        <section class="content">
            <p>
                I understand that the Laptop and accessories that the company has provided me with are the property
                of the RMG Sustainability Council. I agree to all of the terms in the Laptop Policy.
            </p>
            <p>
                I understand that I am personally responsible for the proper care and use of the Laptop, related
                equipment and accessories. In case of damage or loss, I will immediately notify the RSC Manager HR
                & Ops. I understand that in the event of loss or damage due to my negligence, I may be required to
                replace or pay the full cost of replacement of the damaged or lost equipment according to the RSC
                policy.
            </p>
            <p>
                I will not allow any other individuals to use the Laptop provided to me by the RSC.
            </p>
            <div class="info">
                <table class="table bordered">
                    <tr>
                        <td>Employee Code</td>
                        <td>:</td>
                        <td colspan="4">264</td>
                    </tr>
                    <tr>
                        <td>Employee Name</td>
                        <td>:</td>
                        <td colspan="4">Md. Sumon Islam</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>:</td>
                        <td colspan="4">Junior It Officer</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center">
                            Laptop Information
                        </td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>:</td>
                        <td>Dell</td>
                        <td>Model</td>
                        <td>:</td>
                        <td>Dell Latitude 3420</td>
                    </tr>
                    <tr>
                        <td>Service Tag(S/N)</td>
                        <td>:</td>
                        <td>REARDRA</td>
                        <td>RSC SL No</td>
                        <td>:</td>
                        <td>RSC/LAP/2022/313</td>
                    </tr>

                    <tr>
                        <td colspan="6" class="text-center">
                            Other Accessories
                        </td>
                    </tr>
                    <tr>
                        <td>Laptop Charger</td>
                        <td>:</td>
                        <td>Charger with Adapter</td>
                        <td>Mouse</td>
                        <td>:</td>
                        <td>N/A</td>
                    </tr>
                    <tr>
                        <td>Pendrive</td>
                        <td>:</td>
                        <td>N/A</td>
                        <td>Laptop Bag</td>
                        <td>:</td>
                        <td>RSC/LAP/2022/313</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p>
                                <b>If used please make additional comments :</b> Re-issued a laptop due to the previous
                                laptop has been
                                USB port and motherboard problem. (RSC/LAP/170 returned to IT-Store)

                            </p>

                        </td>
                    </tr>
                    <tr class="custom">
                        <td style="width: 25%;">Employee Signature</td>
                        <td>:</td>
                        <td colspan="2" style="border-right: none">
                            <div class="line w100" style="padding-top: 18px;">
                        </td>
                        <td colspan="2" style="border-left: none ; ">
                            <div>Date:
                                <div class="line" style="color: #fff;">/</div>
                                <div class="line "> / </div>
                                <div class="line"> / </div>
                            </div>

                        </td>
                    </tr>
                </table>
            </div>

        </section>
        <footer>
            <table>
                <tr>
                    <td>Deliverd By</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>Md. Reajul Islam</td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td>:</td>
                    <td>Manager- Office Operations</td>
                </tr>
            </table>
        </footer>


        <header class="text-center fheader">
            <img src="{{ asset('images/rsc.png') }}" style="height: 54px;" alt="">
            <h3>Laptop /Computer Policy</h3>
        </header>
        <p>
            This policy applies to RSC employees regarding the appropriate use of Laptops supplied by company.
        </p>

        


<p>
    <strong>Eligibility : </strong><br>
    Laptops will be provided to selected staff members exclusively for official use to fulfill the 
    employee duties with the RSC under following terms and conditions:

</p>
<p>
    <strong>Laptop Usage and Service :</strong> <br>
    Procurement or replacement of a Laptop duly recommended by the relevant supervisor is to be 
    submitted to the Manager-HR & Office Operations and subject to approval by the Managing Director. 
    Expenses for purchase of Laptop sets and authorized use fees shall be borne by the RSC. The 
    configuration, brand, model of Laptop shall be determined by the RSC. Damage shown to be caused by 
    user's misuse may result in either the Laptop being confiscated by the employer and/or the employee 
    being obligated to repair the apparatus from RSC nominated service center.
</p>

<p>
    <strong>Lost or Replacement Laptop :</strong> <br>
    RSC expects all employees who have been allocated with Laptops to take the utmost care and 
    responsibility of them.
</p>

<p>
    An employee shall be permitted to take their assigned laptop to their home or outside office. Such 
employee shall exercise due responsibilities for the care and protection of the assigned laptop.

</p>
<p>
        In case of loss or theft of Laptop while carrying outside office, the employee must immediately 
inform the RSC Manager-HR & Ops so that necessary interventions with the service provider can be 
made. In the event of theft, the employee must file a General Dairy (GD) with the appropriate 
Police Station. A copy of GD and loss report must be submitted to the RSC Manager- HR & Ops. After 
ascertaining the cause and depending on the circumstances of the loss, the user may be required to 
pay the book value of the Laptop or the company may replace the laptop or the item may be replaced 
on a cost sharing basis between the employee and company. Replacement and payment shall be 
determined on a case-by-case basis by the company.
</p>


<p>
<strong>Termination of / separation from employment: </strong> <br>
In case of resignation/termination from the employment, the employee must handover the Laptop and 
other accessories to the administration department before leaving the company.
</p>
    </div>
	

</body>

</html>