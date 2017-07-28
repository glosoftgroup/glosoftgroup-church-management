<div class="container-fluid">

         <style>
                 table { font-size: 95%; table-layout: fixed; width: 100%; }
                table { border-collapse: separate; border-spacing: 2px; }
                th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
                th, td { border-radius: 0.25em; border-style: solid; }
                th { background: #EEE; border-color: #BBB; }
                td { border-color: #DDD; }

                header { margin: 0 0 3em; }
                header:after { clear: both; content: ""; display: table; }

                header address { float: left; font-size: 95%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
                header address p { margin: 0 0 0.25em; }
                header span, header img { display: block; float: right; }
                header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
                header img { max-height: 100%; max-width: 100%; }

                article, article address, table.meta, table.inventory { margin: 0 0 3em; }
                article:after { clear: both; content: ""; display: table; }
                article h1 { clip: rect(0 0 0 0); position: absolute; }
                article address { float: left; font-size: 125%; font-weight: bold; }

                table.meta, table.balance { float: right; width: 36%; }
                table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

                 table.meta th { width: 40%; }
                table.meta td { width: 60%; }

                 table.inventory { clear: both; width: 100%; }
                table.inventory th { font-weight: bold; text-align: center; }
                table.inventory td:nth-child(1) { width: 26%; }
                table.inventory td:nth-child(2) { width: 38%; }
                table.inventory td:nth-child(3) { text-align: right; width: 12%; }
                table.inventory td:nth-child(4) { text-align: right; width: 12%; }
                table.inventory td:nth-child(5) { text-align: right; width: 12%; }

                 table.balance th, table.balance td { width: 50%; }
                table.balance td { text-align: right; }

                 aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
                aside h1 { border-color: #999; border-bottom-style: solid; }

                 .totals {
                        border-bottom: 3px double;
                        line-height: 1.7em;
                        padding-bottom: 4px;
                        margin-bottom:5px;
                        font-size:18px;
                }

                .totals-sum {
                        border-bottom: 1px dotted;
                        border-top: 1px solid #000000;
                        font-size: 18px;
                        line-height: 1.7em;
                        margin-bottom: 5px;
                        padding-bottom: 4px;
                }

                .paid-amount{
                        font-size:11px;
                        color:#9d9c9c;
                }

                .totals-area{
                        text-align:right;
                        padding-right:7px;
                }
        </style>

        <div class="row-fluid">
                <div class="span12">
                        <div class="editable-invoice">
                                 <header>
                                        <h1 style=" background: #555; border-radius: 0.25em; color: #FFF; margin: 0 0 1em;
                     padding: 0.5em 0; font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase;">Invoice</h1>
                                        <address>
                                                <h3> Invoice #: 101138</h3>
                                        </address>
                                        <span><img alt="" src="<?php echo base_url('assets/img/logo-.png'); ?>"></span>
                                </header>

                                <article>
                                        <h1>Recipient</h1>
                                        <address>
                                                <p style="font-size:13px;">Jonathan Mutuku,</p>
                                                <p style="font-size:13px;">Akinamama Self Help Group</p>
                                        </address>

                                        <div class="balance  pull-right totals-area" style="width:350px;">
                                                <div class="row-fluid">
                                                        <div class="span6"><span><strong>Invoice #</strong></span></div>
                                                        <div class="span6"><span>101138</span></div>
                                                </div>
                                                <div class="row-fluid">
                                                        <div class="span6"><span><strong>Date</strong></span></div>
                                                        <div class="span6"><span>January 1, 2012</span></div>
                                                </div>

                                                <div class="row-fluid">
                                                        <div class="span6"><span><strong>Amount Due</strong></span></div>
                                                        <div class="span6"><span id="prefix">KES </span><span>600.00</span></div>
                                                </div>

                                        </div>
                                        <table class="inventory">
                                                <thead>
                                                        <tr>
                                                                <th><span>Item</span></th>
                                                                <th><span>Quantity</span></th>
                                                                <th><span>Unit Price</span></th>
                                                                <th><span>Account</span></th>

                                                                <th><span> Amount</span></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr>
                                                                <td><span>Front End Consultation</span></td>
                                                                <td><span>4</span></td>
                                                                <td><span data-prefix> KES </span><span> 150.00</span></td>
                                                                <td><span>Office Equipment</span></td>
                                                                <td><span data-prefix> KES </span><span>600.00</span></td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                        <div class="balance  pull-right totals-area" style="width:350px;">

                                                <div class="row-fluid totals-sum">
                                                        <div class="span6"><span><strong>Total</strong></span></div>
                                                        <div class="span6"><span data-prefix>KES </span><span> 600.00</span></div>
                                                </div>

                                                <div class="row-fluid totals">
                                                        <div class="span6"><span><strong>Balance Due</strong></span></div>
                                                        <div class="span6"><span data-prefix>KES </span><span> 600.00</span></div>
                                                </div>

                                        </div>
                                </article>
                                 <aside>
                                        <h1><span>Additional Notes</span></h1>
                                        <div>
                                                <p style="text-align:center;">A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
                                        </div>
                                </aside>

                        </div>
                </div>
        </div>
</div>