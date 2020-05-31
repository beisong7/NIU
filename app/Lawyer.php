<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    //
    public  function fields(){
        $fields = [
            'FirstName', 'Initials', 'LastName', 'DateOfBirth', 'Email', 'AlternativeEmail', 'EnrollmentNumber',
            'NBANumber', 'ADID', 'OfficePhone', 'MobilePhone', 'AlternativePhone', 'Address', 'StateOfOrigin',
            'Photo', 'Status', 'Sex', 'Username', 'DisplayName', 'Created', 'CreatedBy', 'ApprovedBy', 'IsMailCreated',
            'MailCreated', 'IsSupremeCourtApproved', 'IsSAN', 'IsAgreedToTerms', 'OfficeName', 'PostalCode', 'PostOfficeBox',
            'Title', 'City', 'EmployeeStartDate', 'EmployeeEndDate', 'ActivationCode', 'Password', 'HasUpdate', 'LastUpdated',
            'LastLogin', 'StateId', 'RefNo', 'PreviousName', 'Comments', 'OTP'
        ];
    }

    public function getFullnameAttribute(){
        return "{$this->FirstName} {$this->LastName}";
    }
}
