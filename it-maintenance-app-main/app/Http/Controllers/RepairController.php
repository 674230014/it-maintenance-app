<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function technicianIndex()
    {
        $repairs = Repair::latest()->paginate(10);
        $stats = [
            'total' => Repair::count(),
            'pending' => Repair::where('status', 'pending')->count(),
            'in_progress' => Repair::where('status', 'in_progress')->count(),
            'success' => Repair::where('status', 'success')->count(),
        ];
        return view('repairs.technician', compact('repairs', 'stats'));
    }

    public function create()
    {
        return view('repairs.create');
    }

    public function history()
    {
        $repairs = Repair::latest()->paginate(10);
        return view('repairs.history', compact('repairs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_code' => 'required|string|max:100',
            'equipment_name' => 'required|string|max:255',
            'problem_detail' => 'required|string',
            'urgency' => 'required|in:normal,medium,high,urgent',
            'reporter_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('repair_images', 'public');
        }

        Repair::create([
            'equipment_code' => $request->equipment_code,
            'equipment_name' => $request->equipment_name,
            'problem_detail' => $request->problem_detail,
            'urgency' => $request->urgency,
            'reporter_name' => $request->reporter_name,
            'image_path' => $imagePath,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        return redirect()->route('repairs.history')->with('success', 'ส่งเรื่องแจ้งซ่อมสำเร็จ!');
    }

    public function updateStatus(Request $request, Repair $repair)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,success,rejected',
            'repair_details' => 'nullable|string',
            'price' => 'nullable|numeric|min:0'
        ]);

        $repair->update([
            'status' => $request->status,
            'repair_details' => $request->repair_details,
            'price' => $request->price ?? 0
        ]);

        return back()->with('success', 'บันทึกข้อมูลและอัปเดตสถานะงานซ่อมสำเร็จ!');
    }

    public function uploadSlip(Request $request, Repair $repair)
    {
        $request->validate([
            'slip' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $slipPath = $request->file('slip')->store('payment_slips', 'public');

        $repair->update([
            'slip_path' => $slipPath,
            'payment_status' => 'pending_approval'
        ]);

        return back()->with('success', 'แนบสลิปโอนเงินสำเร็จ! กรุณารอช่างตรวจสอบและอนุมัติ');
    }

    public function approveSlip(Repair $repair)
    {
        $repair->update([
            'payment_status' => 'paid'
        ]);

        return back()->with('success', 'อนุมัติสลิปโอนเงินเรียบร้อย ลูกค้าสามารถพิมพ์ใบเสร็จได้แล้ว');
    }

    public function receipt(Repair $repair)
    {
        if ($repair->payment_status !== 'paid') {
            abort(403, 'ยังไม่ได้รับอนุมัติการชำระเงิน ไม่สามารถพิมพ์ใบเสร็จได้');
        }
        return view('repairs.receipt', compact('repair'));
    }
}