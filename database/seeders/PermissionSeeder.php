<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (Schema::hasTable('permissions')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('permissions')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        //        Permission
        Permission::create([
            'type' => 'Permission',
            'name' => 'Manage Permission'
        ]);

        // Role
        Permission::create([
            'type' => 'Role',
            'name' => 'List Of Role'
        ]);
        Permission::create([
            'type' => 'Role',
            'name' => 'Create Role'
        ]);
        Permission::create([
            'type' => 'Role',
            'name' => 'Manage Role'
        ]);
        Permission::create([
            'type' => 'Role',
            'name' => 'Delete Role'
        ]);

        //      User
        Permission::create([
            'type' => 'User',
            'name' => 'List Of User'
        ]);
        Permission::create([
            'type' => 'User',
            'name' => 'Create User'
        ]);
        Permission::create([
            'type' => 'User',
            'name' => 'Manage User'
        ]);
        Permission::create([
            'type' => 'User',
            'name' => 'Delete User'
        ]);
        Permission::create([
            'type' => 'User',
            'name' => 'View User'
        ]);


        //      ISP
        Permission::create([
            'type' => 'ISP',
            'name' => 'List Of ISP'
        ]);
        Permission::create([
            'type' => 'ISP',
            'name' => 'View ISP'
        ]);
        Permission::create([
            'type' => 'ISP',
            'name' => 'Approve ISP'
        ]);
        // Permission::create([
        //     'type' => 'ISP',
        //     'name' => 'Manage ISP'
        // ]);
        // Permission::create([
        //     'type' => 'ISP',
        //     'name' => 'Delete ISP'
        // ]);


        //      BCC Staff
        Permission::create([
            'type' => 'BCC Staff',
            'name' => 'List Of BCC Staff'
        ]);
        Permission::create([
            'type' => 'BCC Staff',
            'name' => 'Create BCC Staff'
        ]);
        Permission::create([
            'type' => 'BCC Staff',
            'name' => 'View BCC Staff'
        ]);
        Permission::create([
            'type' => 'BCC Staff',
            'name' => 'Manage BCC Staff'
        ]);
        Permission::create([
            'type' => 'BCC Staff',
            'name' => 'Delete BCC Staff'
        ]);

        //      NTTN Staff
        Permission::create([
            'type' => 'NTTN Staff',
            'name' => 'List Of NTTN Staff'
        ]);
        Permission::create([
            'type' => 'NTTN Staff',
            'name' => 'Create NTTN Staff'
        ]);
        Permission::create([
            'type' => 'NTTN Staff',
            'name' => 'Manage NTTN Staff'
        ]);
        Permission::create([
            'type' => 'NTTN Staff',
            'name' => 'Delete NTTN Staff'
        ]);

        //      NTTN Datas
        Permission::create([
            'type' => 'NTTN Datas',
            'name' => 'List Of NTTN Datas'
        ]);
        Permission::create([
            'type' => 'NTTN Datas',
            'name' => 'Create NTTN Data'
        ]);
        Permission::create([
            'type' => 'NTTN Datas',
            'name' => 'Manage NTTN Data'
        ]);
        Permission::create([
            'type' => 'NTTN Datas',
            'name' => 'Delete NTTN Data'
        ]);


        //      Regions
        Permission::create([
            'type' => 'Regions',
            'name' => 'List Of Regions'
        ]);
        Permission::create([
            'type' => 'Regions',
            'name' => 'Create Regions'
        ]);
        Permission::create([
            'type' => 'Regions',
            'name' => 'Manage Regions'
        ]);
        Permission::create([
            'type' => 'Regions',
            'name' => 'Delete Regions'
        ]);

        //      ISP Connection
        Permission::create([
            'type' => 'ISP Connection',
            'name' => 'List Of ISP Connection'
        ]);
        Permission::create([
            'type' => 'ISP Connection',
            'name' => 'Create ISP Connection'
        ]);
        Permission::create([
            'type' => 'ISP Connection',
            'name' => 'Accept ISP Connection'
        ]);
        Permission::create([
            'type' => 'ISP Connection',
            'name' => 'Decline ISP Connection'
        ]);
        Permission::create([
            'type' => 'ISP Connection',
            'name' => 'View ISP Connection'
        ]);
        Permission::create([
            'type' => 'ISP Connection',
            'name' => 'Search ISP Connection'
        ]);

        //      NDC User
        Permission::create([
            'type' => 'NDC User',
            'name' => 'List Of NDC User'
        ]);
        Permission::create([
            'type' => 'NDC User',
            'name' => 'Create NDC User'
        ]);
        Permission::create([
            'type' => 'NDC User',
            'name' => 'Manage NDC User'
        ]);
        Permission::create([
            'type' => 'NDC User',
            'name' => 'Delete NDC User'
        ]);

        //      NDC Appointment
        Permission::create([
            'type' => 'NDC Appointment',
            'name' => 'List Of NDC Appointment'
        ]);
        Permission::create([
            'type' => 'NDC Appointment',
            'name' => 'Create NDC Appointment'
        ]);
        Permission::create([
            'type' => 'NDC Appointment',
            'name' => 'Manage NDC Appointment'
        ]);
        Permission::create([
            'type' => 'NDC Appointment',
            'name' => 'Approve NDC Appointment'
        ]);
        Permission::create([
            'type' => 'NDC Appointment',
            'name' => 'Update Time NDC Appointment'
        ]);
        Permission::create([
            'type' => 'NDC Appointment',
            'name' => 'Print NDC Appointment'
        ]);

        // ITEE Students
        Permission::create([
            'type' => 'ITEE Students',
            'name' => 'List Of ITEE Students'
        ]);
        Permission::create([
            'type' => 'ITEE Students',
            'name' => 'Create ITEE Students'
        ]);
        Permission::create([
            'type' => 'ITEE Students',
            'name' => 'Update ITEE Students'
        ]);
        Permission::create([
            'type' => 'ITEE Students',
            'name' => 'Delete ITEE Students'
        ]);


        // ITEE Books
        Permission::create([
            'type' => 'ITEE Books',
            'name' => 'List Of ITEE Books'
        ]);
        Permission::create([
            'type' => 'ITEE Books',
            'name' => 'Create ITEE Books'
        ]);
        Permission::create([
            'type' => 'ITEE Books',
            'name' => 'Update ITEE Books'
        ]);
        Permission::create([
            'type' => 'ITEE Books',
            'name' => 'Delete ITEE Books'
        ]);


        // ITEE Results
        Permission::create([
            'type' => 'ITEE Results',
            'name' => 'List Of ITEE Results'
        ]);
        Permission::create([
            'type' => 'ITEE Results',
            'name' => 'Create ITEE Results'
        ]);
        Permission::create([
            'type' => 'ITEE Results',
            'name' => 'Update ITEE Results'
        ]);
        Permission::create([
            'type' => 'ITEE Results',
            'name' => 'Delete ITEE Results'
        ]);

        // ITEE ExamFee
        Permission::create([
            'type' => 'ITEE ExamFee',
            'name' => 'List Of ITEE ExamFee'
        ]);
        Permission::create([
            'type' => 'ITEE ExamFee',
            'name' => 'Create ITEE ExamFee'
        ]);
        Permission::create([
            'type' => 'ITEE ExamFee',
            'name' => 'Update ITEE ExamFee'
        ]);
        Permission::create([
            'type' => 'ITEE ExamFee',
            'name' => 'Delete ITEE ExamFee'
        ]);


        //      ITEE Notice
        Permission::create([
            'type' => 'ITEE Notice',
            'name' => 'List Of ITEE Notice'
        ]);
        Permission::create([
            'type' => 'ITEE Notice',
            'name' => 'Create ITEE Notice'
        ]);
        Permission::create([
            'type' => 'ITEE Notice',
            'name' => 'Update ITEE Notice'
        ]);
        Permission::create([
            'type' => 'ITEE Notice',
            'name' => 'Delete ITEE Notice'
        ]);


        //      ITEE Venue
        Permission::create([
            'type' => 'ITEE Venue',
            'name' => 'List Of ITEE Venue'
        ]);
        Permission::create([
            'type' => 'ITEE Venue',
            'name' => 'Create ITEE Venue'
        ]);
        Permission::create([
            'type' => 'ITEE Venue',
            'name' => 'Update ITEE Venue'
        ]);
        Permission::create([
            'type' => 'ITEE Venue',
            'name' => 'Delete ITEE Venue'
        ]);


        //      ITEE Exam Category
        Permission::create([
            'type' => 'ITEE Exam Category',
            'name' => 'List Of ITEE Exam Category'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Category',
            'name' => 'Create ITEE Exam Category'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Category',
            'name' => 'Update ITEE Exam Category'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Category',
            'name' => 'Delete ITEE Exam Category'
        ]);


        //      ITEE Exam Type
        Permission::create([
            'type' => 'ITEE Exam Type',
            'name' => 'List Of ITEE Exam Type'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Type',
            'name' => 'Create ITEE Exam Type'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Type',
            'name' => 'Update ITEE Exam Type'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Type',
            'name' => 'Delete ITEE Exam Type'
        ]);


        //      ITEE Syllabus
        Permission::create([
            'type' => 'ITEE Syllabus',
            'name' => 'List Of ITEE Syllabus'
        ]);
        Permission::create([
            'type' => 'ITEE Syllabus',
            'name' => 'Create ITEE Syllabus'
        ]);
        Permission::create([
            'type' => 'ITEE Syllabus',
            'name' => 'Update ITEE Syllabus'
        ]);
        Permission::create([
            'type' => 'ITEE Syllabus',
            'name' => 'Delete ITEE Syllabus'
        ]);

        //      ITEE Course Outline
        Permission::create([
            'type' => 'ITEE Course Outline',
            'name' => 'List Of ITEE Course Outline'
        ]);
        Permission::create([
            'type' => 'ITEE Course Outline',
            'name' => 'Create ITEE Course Outline'
        ]);
        Permission::create([
            'type' => 'ITEE Course Outline',
            'name' => 'Update ITEE Course Outline'
        ]);
        Permission::create([
            'type' => 'ITEE Course Outline',
            'name' => 'Delete ITEE Course Outline'
        ]);

        //      ITEE Exam Application
        Permission::create([
            'type' => 'ITEE Exam Application',
            'name' => 'List Of ITEE Exam Application'
        ]);
        Permission::create([
            'type' => 'ITEE Exam Application',
            'name' => 'Manage ITEE Exam Application'
        ]);



        // VM Car Information
        Permission::create([
            'type' => 'VM Car Information',
            'name' => 'List Of VM Car Information'
        ]);
        Permission::create([
            'type' => 'VM Car Information',
            'name' => 'Create VM Car Information'
        ]);
        Permission::create([
            'type' => 'VM Car Information',
            'name' => 'Update VM Car Information'
        ]);
        Permission::create([
            'type' => 'VM Car Information',
            'name' => 'Delete VM Car Information'
        ]);

        // VM User Information
        Permission::create([
            'type' => 'VM Car User',
            'name' => 'List Of Vehicle Management User'
        ]);
        Permission::create([
            'type' => 'VM Car User',
            'name' => 'Create Vehicle Management User'
        ]);
        Permission::create([
            'type' => 'VM Car User',
            'name' => 'Manage Vehicle Management User'
        ]);
        Permission::create([
            'type' => 'VM Car User',
            'name' => 'Delete Vehicle Management User'
        ]);

        // VM Car Assign By Driver Information
        Permission::create([
            'type' => 'VM Car Assign',
            'name' => 'List Of VM User Car Assign'
        ]);
        Permission::create([
            'type' => 'VM Car Assign',
            'name' => 'Create Of VM User Car Assign'
        ]);
        Permission::create([
            'type' => 'VM Car Assign',
            'name' => 'Delete Of VM User Car Assign'
        ]);

        //      Staff Hierarchy
        Permission::create([
            'type' => 'Staff Hierarchy',
            'name' => 'View Staff Hierarchy'
        ]);
        Permission::create([
            'type' => 'Staff Hierarchy',
            'name' => 'Manage Staff Hierarchy'
        ]);

        // VM Car Assign By Driver Information
        Permission::create([
            'type' => 'VM Car Trip',
            'name' => 'List Of VM Trip'
        ]);
        Permission::create([
            'type' => 'VM Car Trip',
            'name' => 'View VM Trip'
        ]);
        Permission::create([
            'type' => 'VM Car Trip',
            'name' => 'Approve VM Trip'
        ]);

        Permission::create([
            'type' => 'VM Car Trip',
            'name' => 'VM Car Assign Trip'
        ]);

        //      Division
        Permission::create([
            'type' => 'Division',
            'name' => 'List Of Division'
        ]);
        Permission::create([
            'type' => 'Division',
            'name' => 'Create Division'
        ]);
        Permission::create([
            'type' => 'Division',
            'name' => 'Manage Division'
        ]);
        Permission::create([
            'type' => 'Division',
            'name' => 'Delete Division'
        ]);
        Permission::create([
            'type' => 'Division',
            'name' => 'View Division'
        ]);


        //      District
        Permission::create([
            'type' => 'District',
            'name' => 'List Of District'
        ]);
        Permission::create([
            'type' => 'District',
            'name' => 'Create District'
        ]);
        Permission::create([
            'type' => 'District',
            'name' => 'Manage District'
        ]);
        Permission::create([
            'type' => 'District',
            'name' => 'Delete District'
        ]);
        Permission::create([
            'type' => 'District',
            'name' => 'View District'
        ]);


        //      Upazila
        Permission::create([
            'type' => 'Upazila',
            'name' => 'List Of Upazila'
        ]);
        Permission::create([
            'type' => 'Upazila',
            'name' => 'Create Upazila'
        ]);
        Permission::create([
            'type' => 'Upazila',
            'name' => 'Manage Upazila'
        ]);
        Permission::create([
            'type' => 'Upazila',
            'name' => 'Delete Upazila'
        ]);
        Permission::create([
            'type' => 'Upazila',
            'name' => 'View Upazila'
        ]);


        // BKIICT

        // BKIICT Center
        Permission::create([
            'type' => 'BKIICT Center',
            'name' => 'List Of BKIICT Center'
        ]);
        Permission::create([
            'type' => 'BKIICT Center',
            'name' => 'View BKIICT Center'
        ]);
        Permission::create([
            'type' => 'BKIICT Center',
            'name' => 'Update BKIICT Center'
        ]);
        Permission::create([
            'type' => 'BKIICT Center',
            'name' => 'Delete BKIICT Center'
        ]);

        // BKIICT Course
        Permission::create([
            'type' => 'BKIICT Course',
            'name' => 'List Of BKIICT Course'
        ]);
        Permission::create([
            'type' => 'BKIICT Course',
            'name' => 'View BKIICT Course'
        ]);
        Permission::create([
            'type' => 'BKIICT Course',
            'name' => 'Update BKIICT Course'
        ]);
        Permission::create([
            'type' => 'BKIICT Course',
            'name' => 'Delete BKIICT Course'
        ]);

        // BKIICT User
        Permission::create([
            'type' => 'BKIICT User',
            'name' => 'List Of BKIICT User'
        ]);
        Permission::create([
            'type' => 'BKIICT User',
            'name' => 'Create BKIICT User'
        ]);
        Permission::create([
            'type' => 'BKIICT User',
            'name' => 'Update BKIICT User'
        ]);
        Permission::create([
            'type' => 'BKIICT User',
            'name' => 'Delete BKIICT User'
        ]);

        // BKIICT Teacher
        Permission::create([
            'type' => 'BKIICT Teacher',
            'name' => 'List Of BKIICT Teacher'
        ]);
        Permission::create([
            'type' => 'BKIICT Teacher',
            'name' => 'Create BKIICT Teacher'
        ]);
        Permission::create([
            'type' => 'BKIICT Teacher',
            'name' => 'Update BKIICT Teacher'
        ]);
        Permission::create([
            'type' => 'BKIICT Teacher',
            'name' => 'Delete BKIICT Teacher'
        ]);


        // BKIICT Teacher
        Permission::create([
            'type' => 'BKIICT Batch',
            'name' => 'List Of BKIICT Batch'
        ]);
        Permission::create([
            'type' => 'BKIICT Batch',
            'name' => 'Create BKIICT Batch'
        ]);
        Permission::create([
            'type' => 'BKIICT Batch',
            'name' => 'Update BKIICT Batch'
        ]);
        Permission::create([
            'type' => 'BKIICT Batch',
            'name' => 'Delete BKIICT Batch'
        ]);


        // BKIICT Course PDF
        Permission::create([
            'type' => 'BKIICT Course PDF',
            'name' => 'List Of BKIICT Course PDF'
        ]);
        Permission::create([
            'type' => 'BKIICT Course PDF',
            'name' => 'Create BKIICT Course PDF'
        ]);
        Permission::create([
            'type' => 'BKIICT Course PDF',
            'name' => 'Update BKIICT Course PDF'
        ]);
        Permission::create([
            'type' => 'BKIICT Course PDF',
            'name' => 'Delete BKIICT Course PDF'
        ]);


        // ITEE BJIT Events
        Permission::create([
            'type' => 'ITEE BJIT Events',
            'name' => 'List Of Bjet Events'
        ]);
        Permission::create([
            'type' => 'ITEE BJIT Events',
            'name' => 'Create Bjet Events'
        ]);
        Permission::create([
            'type' => 'ITEE BJIT Events',
            'name' => 'Update Bjet Events'
        ]);
        Permission::create([
            'type' => 'ITEE BJIT Events',
            'name' => 'Delete Bjet Events'
        ]);


        // ITEE Programs
        Permission::create([
            'type' => 'ITEE Programs',
            'name' => 'List Of ITEE Programs'
        ]);
        Permission::create([
            'type' => 'ITEE Programs',
            'name' => 'Create ITEE Programs'
        ]);
        Permission::create([
            'type' => 'ITEE Programs',
            'name' => 'Update ITEE Programs'
        ]);
        Permission::create([
            'type' => 'ITEE Programs',
            'name' => 'Delete ITEE Programs'
        ]);


        // ITEE Recent Events
        Permission::create([
            'type' => 'ITEE Recent Events',
            'name' => 'List Of Recent Events'
        ]);
        Permission::create([
            'type' => 'ITEE Recent Events',
            'name' => 'Create Recent Events'
        ]);
        Permission::create([
            'type' => 'ITEE Recent Events',
            'name' => 'Update Recent Events'
        ]);
        Permission::create([
            'type' => 'ITEE Recent Events',
            'name' => 'Delete Recent Events'
        ]);

        // ITEE Admit Card
        Permission::create([
            'type' => 'ITEE Admit Card',
            'name' => 'Manage ITEE Admit Card'
        ]);
        Permission::create([
            'type' => 'ITEE Admit Card',
            'name' => 'List Of ITEE Admit Card'
        ]);
        Permission::create([
            'type' => 'ITEE Admit Card',
            'name' => 'Create ITEE Admit Card'
        ]);
        Permission::create([
            'type' => 'ITEE Admit Card',
            'name' => 'Update ITEE Admit Card'
        ]);
        Permission::create([
            'type' => 'ITEE Admit Card',
            'name' => 'Delete ITEE Admit Card'
        ]);

    }
}