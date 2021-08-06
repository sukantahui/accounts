<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAllProceduresAndFunctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS getUsers;
                        CREATE PROCEDURE getUsers()
                        BEGIN
                            SELECT * FROM users;
                        END'
        );
        DB::unprepared('drop FUNCTION IF EXISTS notional_monthly_fees_chargeable_count;
                        CREATE FUNCTION notional_monthly_fees_chargeable_count (input_scr_id bigint) RETURNS int
                        DETERMINISTIC
                        BEGIN
                          DECLARE month_count int;
                          select TIMESTAMPDIFF(MONTH, effective_date, CURDATE())+1 INTO month_count from student_course_registrations where id=input_scr_id and is_completed=0 and is_started=1;
                            RETURN month_count;
                        END'
        );
        DB::unprepared('drop FUNCTION IF EXISTS get_fees_mode_by_scr_id ;
                        CREATE FUNCTION get_fees_mode_by_scr_id (input_scr_id bigint) RETURNS int
                        DETERMINISTIC
                        BEGIN
                        DECLARE mode_id int;
                            select courses.fees_mode_type_id INTO mode_id from student_course_registrations inner join courses ON courses.id = student_course_registrations.course_id
                        inner join transaction_masters on student_course_registrations.id = transaction_masters.student_course_registration_id
                        where student_course_registrations.id=input_scr_id ;
                            RETURN mode_id;
                        END'

        );
        //this function will return the year of last monthly fees charged for a SCR number
        DB::unprepared('DROP FUNCTION IF EXISTS get_year_of_last_monthly_fees_charged;
                            CREATE FUNCTION get_year_of_last_monthly_fees_charged(input_scr_id bigint) RETURNS int
                            DETERMINISTIC
                            BEGIN
                              DECLARE temp_fees_year int;
                              select fees_year into temp_fees_year  from transaction_masters
                                inner join transaction_details on transaction_details.transaction_master_id = transaction_masters.id
                                where voucher_type_id=9 and student_course_registration_id=input_scr_id and transaction_details.ledger_id=9
                                order by transaction_masters.fees_year desc, transaction_masters.fees_month desc limit 1;
                              IF(temp_fees_year IS NULL) THEN
                                  SET temp_fees_year := 0;
                              END IF;
                                RETURN temp_fees_year;
                            END'

        );
    }

    public function down()
    {
        Schema::dropIfExists('all_procedures_and_functions');
    }
}
