<?php
$employer = auth()->user()->employer;
?>
@extends('employer.overview-jobs.layouts.app')
@section('title', $employer->company_name)
@section('dashboard_content')
    <div class="card new-shadow-sidebar">
        <div class="card-body padding-card-body">
            <div class="description-box top2-description1 pt-0">
                <div class="col-lg-12">
                    <h4 class="tab-main-title">
                        <span class="tab-icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </span> &nbsp;
                        Summary
                    </h4>
                </div>
                <div class="col-lg-12">
                    <?=$employer->company_description?>
                </div>
            </div>
            <div class="description-box top2-description2">
                <div class="col-lg-12">
                    <h4 class="tab-main-title">
                        <span class="tab-icon"><i class="fa-solid fa-gear"></i></span> &nbsp;
                        Services
                    </h4>
                </div>
                <div class="col-lg-12 points-list">
                    <?=$employer->services?>
                </div>
            </div>
            <div class="description-box top2-description2">
                <div class="col-lg-12">
                    <h4 class="tab-main-title">
                        <span class="tab-icon">
                            <i class="fa-solid fa-id-card-clip"></i>
                        </span> &nbsp;
                        Contacts
                    </h4>
                </div>
                <div class="row">
                    @if (@$employer->contact_persons_information)
                        <?php
                        $infos = json_decode(@$employer->contact_persons_information);
                        $name = $infos->name;
                        $email = $infos->email;
                        $designation = $infos->designation;
                        $mobile = $infos->number;
                        
                        $count = count($name);
                        ?>
                        @for ($i = 0; $i < $count; $i++)
                            <div class="col-lg-6">
                                <div class="contact-person-info">
                                    <p class="contact-name">{{ $name[$i] }}</p>
                                    <div class="ending-content-gradient-box">
                                        <p>
                                            <span class="top-icon">
                                                <i class="fa-solid fa-briefcase"></i> :&nbsp;
                                            </span>
                                            {{ $designation[$i] }}
                                        </p>
                                        <p>
                                            <span class="top-icon">
                                                <i class="fa-solid fa-envelope"></i> :&nbsp;
                                            </span>
                                            <a href="mailto:{{ $email[$i] }}">{{ $email[$i] }}</a>
                                        </p>
                                        <p>
                                            <span class="top-icon">
                                                <i class="fa-solid fa-phone"></i> :&nbsp;
                                            </span>
                                            <a href="tel:{{ $mobile[$i] }}">{{ $mobile[$i] }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        <div class="col-md-12">
                            <div class="contact-person-info text-center">
                                No Contacts Available
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
