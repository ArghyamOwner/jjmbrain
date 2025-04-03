<?php

namespace App\Traits;

use App\Traits\WithPermissions;

trait WithRoles
{
    use WithPermissions;
    
    public function isSuperAdministrator()
    {
        return $this->role === 'super-admin';
    }

    public function isAdministratorOrSuper()
    {
        return $this->role === 'admin' || $this->role === 'super-admin';
    }

    public function isPrincipalOrTeacher()
    {
        return $this->role === 'principal' || $this->role === 'teacher';
    }

    public function isAdministrator()
    {
        return $this->role === 'admin';
    }

    public function isSubAdministrator()
    {
        return $this->role === 'sub-admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isPrincipal()
    {
        return $this->role === 'principal';
    }

    public function isGuardian()
    {
        return $this->role === 'guardian';
    }

    public function isSchoolInspector()
    {
        return $this->role === 'school-inspector';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isCallCenter()
    {
        return $this->role === 'call-center';
    }

    public function isDPMU()
    {
        return $this->role === 'dpmu';
    }

    public function isPanchayat()
    {
        return $this->role === 'panchayat';
    }

    public function isExecutiveEngineer()
    {
        return $this->role === 'executive-engineer';
    }
  
    public function isSectionOfficer()
    {
        return $this->role === 'section-officer';
    }

    public function isTpaAdmin()
    {
        return $this->role === 'tpa-admin';
    }

    public function isJalMitra()
    {
        return $this->role === 'jal-mitra';
    }

    public function isAddChiefEngineer()
    {
        return $this->role === 'add-chief-engineer';
    }

    public function isSuperintendentEngineer()
    {
        return $this->role === 'superitendent-engineer';
    }

    public function isAsrlmBlock()
    {
        return $this->role === 'asrlm-block';
    }

    public function isHeadOffice()
    {
        return $this->role === 'head-office';
    }

    public function isIsaCoordinator()
    {
        return $this->role === 'isa-coordinator';
    }

    public function isLabTechnicalOfficer()
    {
        return $this->role === 'lab-technical-officer';
    }

    public function isLabNodalOfficer()
    {
        return $this->role === 'lab-nodal-officer';
    }

    public function isLabHo()
    {
        return $this->role === 'lab-ho';
    }

    public function isSdo()
    {
        return $this->role === 'sdo';
    }

    public function isGeologyHo()
    {
        return $this->role === 'geology-ho';
    }

    public function isDistrictJaldootCell()
    {
        return $this->role === 'district-jaldoot-cell';
    }

    public function isStateJaldootCell()
    {
        return $this->role === 'state-jaldoot-cell';
    }

    public function isStateIsa()
    {
        return $this->role === 'state-isa';
    }

    public function isAdministratorOrStateJaldootCell()
    {
        return $this->role === 'admin' || $this->role === 'state-jaldoot-cell';
    }

    public function isAdministratorOrLabHo()
    {
        return $this->role === 'admin' || $this->role === 'lab-ho';
    }

    public function isIecSpecialist()
    {
        return $this->role === 'iec-specialist';
    }

    public function isCeoZp()
    {
        return $this->role === 'ceo_zp';
    }

    public function isBlockUser()
    {
        return $this->role === 'block-user';
    }

    public function isPanchayatCommissioner()
    {
        return $this->role === 'panchayat_commissioner';
    }

    public function isTechSupport()
    {
        return $this->role === 'tech-support';
    }

    public function isGisExpert()
    {
        return $this->role === 'gis-expert';
    }

    public function isDc()
    {
        return $this->role === 'dc';
    }

    public function isWucAuditor()
    {
        return $this->role === 'wuc-auditor';
    }
    
    public function isContractor()
    {
        return $this->role === 'contractor';
    }

    public function isIotVendor()
    {
        return $this->role === 'iot-vendor';
    }

    public function isLabAdmin()
    {
        return $this->role === 'lab-admin';
    }

    public function isAdministratorOrLabHoOrLabAdmin()
    {
        return $this->role === 'admin' || $this->role === 'lab-ho' || $this->role === 'lab-admin';
    }

    public function isAdministratorOrLabAdmin()
    {
        return $this->role === 'admin' || $this->role === 'lab-admin';
    }
}