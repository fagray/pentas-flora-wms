@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="page-header">Help Centre</h2>
    <div class="row">
        <div class="col-md-2">
            <ul class="list-group">
                <p> Definition of Terms: </p>
                <ul>
                    <li><a href="#jobOrderModule"> Job Order Module </a></li>
                </ul>
            </ul>
        </div>
        <div class="col-md-10">
            <section id="jobOrderModule">
                <p class="font-weight-bold page-header">Job Order Module</p>
                <p>Agreement Types</p>
                <ul>
                    <li>Monthly <p>
                        <i>Type where customers are billed per month after a few collections.</i> </p>
                    </li>
                    <li>Adhoc
                        <p>
                            <i>Type where customers are billed directly after a collection</i>
                        </p>
                    </li>
                    <li>Partial
                        <p>
                            <i>Type where customers are billed a percentage of the amount (Usually transportation fee).</i>
                        </p>
                    </li>
                    <li>Pro-forma
                        <p>
                            <i>Type where customers are billed in advance for full amount, then billed again if there are any changes</i>
                        </p>
                    </li>
                </ul>
                <p>Job Collection Statuses</p>
                <ul>
                    <li><strong>Open  </strong><p>
                        <i>Default status for newly created job collection order.
                        It means that the <strong> job hasn't assigned to anyone yet and not
                        yet fulfilled the payment based on the job collection's agreement type. </strong></i> </p>
                    </li>
                    <li><strong>Assigned </strong>
                        <p>
                            <i>
                                It means that the job <strong> has been marked for collection </strong>
                                which involves collection date and driver details.</i> </p>
                    </li>
                    <li><strong>Completed </strong>
                        <p>
                            <i>
                                It means that the job <strong> has already fulfilled the collection procedures </strong>
                                on the respected company/workshop.    
                                A notification will be given to the admin to verify and approve the collection.
                                </i> </p>
                    </li>
                    
                    <li><strong>Verified </strong>
                        <p>
                            <i>
                                It means that the job <strong> has fulfilled the collection, verified by the admin and 
                                    the company settled the payment.</strong>
                    
                            </i> </p>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</div>
@endsection
