<?php

namespace App\Http\Livewire\Management;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Management\Zone;
use App\Models\Management\Aduit;
use App\Models\Management\Feeder;
use Illuminate\Support\Facades\DB;
use App\Models\Management\District;

class AdminDashboard extends Component
{
    public $zone_id,$from_date,$to_date;
    public function render()
    {
        $data['users']=User::count();
        $data['feeders']=Feeder::count();
        $data['districts']=District::count();
        $data['zones']=Zone::count();

        // $audits = Aduit::with('district.zone')
        // ->when($this->zone_id, function ($query) {$query->where('id', $this->zone_id);})
        // ->when($this->from_date, function ($query) {            
        //      $from = Carbon::parse($this->from_date)->toDateTimeString();
        //      $to = Carbon::parse($this->to_date)->addHour(23)->addMinutes(59)->toDateTimeString();
        //      $query->whereBetween('created_at', [$from, $to]) ;})
        // ->get();
        // $auditCount = $audits->map(function ($country) {
        //     $samples = $country->institutions
        //             ->pluck('incominingReferralRequests')->flatten(1)
        //             ->pluck('samples')->flatten(1);
        //     $samplesResults = $country->institutions
        //             ->pluck('incominingReferralRequests')->flatten(1)
        //             ->pluck('samplesResults')->flatten(1);
        //     $samplesPending = $country->institutions
        //             ->pluck('incominingReferralRequests')->flatten(1)
        //             ->pluck('samplesPending')->flatten(1);
        //     $samplesRejected = $country->institutions
        //             ->pluck('incominingReferralRequests')->flatten(1)
        //             ->pluck('samplesRejected')->flatten(1);
        //     return ['name' => $country->name, 'sample_count' => $samples->count(), 'samples_pending'=>$samplesPending->count(),'samples_rejected'=>$samplesRejected->count(),'samples_done'=>$samplesResults->count()];
        // })
        //   ->filter(function ($country) {
        //       return $country['sample_count'] > 0;
        //   })
        //   ->toArray();

        // $data['samplesSequencedPercountry'] = $auditCount;
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $data['main_chart'] = Aduit::where('status','!=','Canceled')
        ->selectRaw('COUNT(*) AS total_audits')
                                  ->selectRaw('COUNT(CASE WHEN anomaly = "Meter Bypass" THEN 1 END) AS meter_bypass')
                                  ->selectRaw('COUNT(CASE WHEN anomaly = "Faulty Meter" THEN 1 END) AS faulty')
                                  ->selectRaw('COUNT(CASE WHEN anomaly = "Meter Ok" THEN 1 END) AS meter_ok')
                                  ->selectRaw('COUNT(CASE WHEN anomaly = "Stolen Meter" THEN 1 END) AS stolen')
                                  ->selectRaw('COUNT(CASE WHEN anomaly = "Abandoned Meter" THEN 1 END) AS abandoned')
                                  ->selectRaw('COUNT(CASE WHEN anomaly = "Tampered Meter" THEN 1 END) AS tampered')
                                  ->selectRaw("DATE_FORMAT(created_at, '%M-%Y') display_date")
                                  ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') new_date")
                                  ->groupBy('new_date')->orderBy('new_date', 'ASC')
        ->get();
        $data['anomaly_status'] = Aduit::where('status','!=','Canceled')->select(DB::raw('count(id) as audit_count'), 'status')->groupBy('status')->get();
        $data['anomaly_counts'] = Aduit::where('status','!=','Canceled')->select(DB::raw('count(id) as audit_count'), 'anomaly')->groupBy('anomaly')->get();
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        return view('livewire.management.admin-dashboard', $data);
    }
}
