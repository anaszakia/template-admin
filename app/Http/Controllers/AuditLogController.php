<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;
use Carbon\Carbon;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest('performed_at');
        
        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('performed_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('performed_at', '<=', $request->date_to);
        }
        
        // Filter berdasarkan action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        
        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('user_email', 'like', "%{$search}%")
                  ->orWhere('ip', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%");
            });
        }
        
        $logs = $query->paginate(20)->appends($request->query());
        
        // Data untuk filter
        $actions = AuditLog::distinct()->pluck('action')->filter();
        $users = \App\Models\User::select('id', 'name', 'email')->get();
        
        return view('admin.audit.index', compact('logs', 'actions', 'users'));
    }
    
    public function show(AuditLog $auditLog)
    {
        $auditLog->load('user');
        return view('admin.audit.show', compact('auditLog'));
    }
    
    public function export(Request $request)
    {
        // Export ke CSV/Excel bisa ditambahkan nanti
        return response()->json(['message' => 'Export feature coming soon']);
    }
}
