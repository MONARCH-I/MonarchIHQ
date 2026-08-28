<x-manager-sidebar>
    <x-slot name="pageTitle">Message from {{ $message->name }}</x-slot>
    <x-slot name="breadcrumb">HR → Messages → View</x-slot>

    <x-slot name="sidebarNav">
        <div class="sidebar-nav-label">HR</div>
        <a href="{{ route('manager.hr.jobs') }}"     class="sidebar-nav-link"><span>💼</span> Job Listings</a>
        <a href="{{ route('manager.hr.messages') }}" class="sidebar-nav-link active"><span>✉️</span> Messages</a>
    </x-slot>

    <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start">

        {{-- Message Body --}}
        <div style="display:flex;flex-direction:column;gap:16px">
            <div class="card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                    <div>
                        <div style="font-size:18px;font-weight:700;color:var(--text-primary)">{{ $message->subject ?? '(No Subject)' }}</div>
                        <div style="font-size:12px;color:var(--text-muted);margin-top:4px">
                            From <strong style="color:var(--text-secondary)">{{ $message->name }}</strong> ({{ $message->email }}) &middot; {{ $message->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <span class="badge {{ $message->statusBadgeClass() }}">{{ $message->statusLabel() }}</span>
                </div>
                <div style="font-size:14px;color:var(--text-secondary);line-height:1.7;white-space:pre-wrap;background:var(--bg-hover);border-radius:10px;padding:16px;border:1px solid var(--border)">{{ $message->message }}</div>
            </div>

            {{-- Reply Form --}}
            <div class="card">
                <div style="font-size:14px;font-weight:700;color:var(--text-primary);margin-bottom:16px">✉️ Send Email Reply</div>
                <form method="POST" action="{{ route('manager.hr.messages.reply', $message) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input name="reply_subject" class="form-input" value="Re: {{ $message->subject ?? 'Your Enquiry' }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message Body</label>
                        <textarea name="reply_body" class="form-textarea" style="min-height:160px" required placeholder="Type your reply here…"></textarea>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px">
                        <button type="submit" class="btn btn-primary">Send Reply to {{ $message->email }}</button>
                        <span style="font-size:11px;color:var(--text-muted)">Will mark message as Replied</span>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div style="display:flex;flex-direction:column;gap:16px">
            {{-- Update Status + Notes --}}
            <div class="card">
                <div style="font-size:13px;font-weight:700;color:var(--text-primary);margin-bottom:14px">Update Status</div>
                <form method="POST" action="{{ route('manager.hr.messages.status', $message) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            @foreach(['new','in_progress','replied','closed'] as $s)
                            <option value="{{ $s }}" {{ $message->status === $s ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Internal Notes</label>
                        <textarea name="hr_notes" class="form-textarea" style="min-height:100px" placeholder="Add internal notes…">{{ $message->hr_notes }}</textarea>
                    </div>
                    <button class="btn btn-secondary" style="width:100%">Save</button>
                </form>
            </div>

            @if($message->replied_at)
            <div class="card" style="border-color:rgba(34,197,94,0.2)">
                <div style="font-size:12px;color:#4ade80">✓ Replied {{ $message->replied_at->format('d M Y, H:i') }}</div>
            </div>
            @endif

            <a href="{{ route('manager.hr.messages') }}" class="btn btn-secondary" style="justify-content:center">← Back to Messages</a>

            @can('delete', $message)
            <form method="POST" action="{{ route('manager.hr.messages.destroy', $message) }}" onsubmit="return confirm('Permanently delete this message?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger" style="width:100%">Delete Message</button>
            </form>
            @endcan
        </div>
    </div>
</x-manager-sidebar>
