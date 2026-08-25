<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            // ── SERVERS ──────────────────────────────────────────────────────
            [
                'category'          => 'servers',
                'name'              => 'MonarchiRack Pro 1U',
                'short_description' => 'Enterprise 1U rack server with dual Xeon processors.',
                'description'       => 'The MonarchiRack Pro 1U is built for mission-critical workloads. Featuring dual Intel Xeon Gold 6348 processors, up to 1TB DDR4 ECC RAM, and NVMe SSD bays for lightning-fast I/O. Ideal for data centres and corporate server rooms.',
                'price'             => 8500.00,
                'sale_price'        => null,
                'stock_quantity'    => 12,
                'is_featured'       => true,
                'badge_text'        => 'Pre-Order',
                'badge_color'       => 'orange',
                'card_style'        => 'dark',
            ],
            [
                'category'          => 'servers',
                'name'              => 'MonarchiTower X8',
                'short_description' => 'High-performance tower server for SMBs.',
                'description'       => 'A versatile tower server designed for growing businesses. Supports up to 8 hot-swap drive bays and redundant power supplies.',
                'price'             => 5200.00,
                'sale_price'        => 4800.00,
                'stock_quantity'    => 8,
                'is_featured'       => false,
                'badge_text'        => 'Sale',
                'badge_color'       => 'red',
                'card_style'        => 'light',
            ],
            [
                'category'          => 'servers',
                'name'              => 'MonarchiEdge Micro',
                'short_description' => 'Compact edge server for remote deployments.',
                'description'       => 'Rugged, fanless edge compute unit with 4-core Intel i5, 32GB RAM, and 1TB SSD. Perfect for branch offices and field deployments.',
                'price'             => 3100.00,
                'stock_quantity'    => 20,
                'is_featured'       => false,
                'badge_text'        => 'New',
                'badge_color'       => 'green',
                'card_style'        => 'light',
            ],

            // ── NETWORKING ───────────────────────────────────────────────────
            [
                'category'          => 'networking',
                'name'              => 'MonarchiSwitch 48P',
                'short_description' => '48-port managed gigabit switch with PoE+.',
                'description'       => 'Layer 3 managed switch with 48 PoE+ ports (802.3at), 4 SFP+ uplinks, and full VLAN/QoS support. Rack-mountable 1U chassis.',
                'price'             => 2800.00,
                'stock_quantity'    => 15,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],
            [
                'category'          => 'networking',
                'name'              => 'MonarchiAP AX6000',
                'short_description' => 'WiFi 6E tri-band enterprise access point.',
                'description'       => 'Next-gen WiFi 6E access point with 6GHz band support, MU-MIMO, OFDMA, and centralised cloud management via the MonarchiCloud portal.',
                'price'             => 1350.00,
                'stock_quantity'    => 30,
                'is_featured'       => true,
                'badge_text'        => 'New',
                'badge_color'       => 'green',
                'card_style'        => 'light',
            ],
            [
                'category'          => 'networking',
                'name'              => 'MonarchiFirewall XG',
                'short_description' => 'Next-generation firewall with deep packet inspection.',
                'description'       => 'Enterprise-grade NGFW with 10Gbps throughput, IDS/IPS, SSL inspection, and centralised policy management.',
                'price'             => 4750.00,
                'stock_quantity'    => 6,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'dark',
            ],

            // ── SECURITY CAMERAS ─────────────────────────────────────────────
            [
                'category'          => 'security-cameras',
                'name'              => 'MonarchiCam 4K PTZ',
                'short_description' => '4K Pan-Tilt-Zoom outdoor IP camera with AI detection.',
                'description'       => 'Professional outdoor PTZ camera with 4K resolution, 30x optical zoom, AI-powered person/vehicle detection, and IR night vision up to 200m.',
                'price'             => 2200.00,
                'sale_price'        => 1950.00,
                'stock_quantity'    => 18,
                'is_featured'       => true,
                'badge_text'        => 'Limited Time',
                'badge_color'       => 'orange',
                'card_style'        => 'promo',
            ],
            [
                'category'          => 'security-cameras',
                'name'              => 'MonarchiDome 2MP',
                'short_description' => 'Indoor dome camera with wide-angle lens.',
                'description'       => 'Compact 2MP indoor dome camera with 180° fisheye lens, PoE, and motion-triggered alerts. Perfect for retail and office surveillance.',
                'price'             => 420.00,
                'stock_quantity'    => 50,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],

            // ── ACCESS CONTROL ───────────────────────────────────────────────
            [
                'category'          => 'access-control',
                'name'              => 'MonarchiAccess Pro Biometric',
                'short_description' => 'Fingerprint + RFID access controller with cloud sync.',
                'description'       => 'Multi-factor access control panel supporting fingerprint, RFID card, and PIN. Manages up to 10,000 users with real-time cloud audit logs.',
                'price'             => 1800.00,
                'stock_quantity'    => 22,
                'is_featured'       => true,
                'badge_text'        => 'New',
                'badge_color'       => 'green',
                'card_style'        => 'dark',
            ],
            [
                'category'          => 'access-control',
                'name'              => 'MonarchiLock Smart EM',
                'short_description' => 'Smart electromagnetic lock with fail-safe mode.',
                'description'       => 'Rated 1200 lb holding force EM lock with fail-safe/fail-secure modes. Works with any access controller via dry contact relay.',
                'price'             => 380.00,
                'stock_quantity'    => 40,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],

            // ── SAAS PLANS ───────────────────────────────────────────────────
            [
                'category'          => 'saas-plans',
                'name'              => 'MonarchiCloud Starter',
                'short_description' => 'Entry-level cloud SaaS platform for startups.',
                'description'       => 'Everything you need to launch your digital business — cloud hosting, SSL, CDN, monitoring, and a 99.9% SLA. Up to 5 users included.',
                'price'             => 299.00,
                'stock_quantity'    => 999,
                'is_featured'       => true,
                'badge_text'        => 'Popular',
                'badge_color'       => 'blue',
                'card_style'        => 'light',
            ],
            [
                'category'          => 'saas-plans',
                'name'              => 'MonarchiCloud Business',
                'short_description' => 'Full-featured SaaS suite for growing businesses.',
                'description'       => 'Includes everything in Starter plus advanced analytics, team collaboration tools, API access, priority support, and up to 25 users.',
                'price'             => 899.00,
                'sale_price'        => 749.00,
                'stock_quantity'    => 999,
                'is_featured'       => false,
                'badge_text'        => 'Sale',
                'badge_color'       => 'red',
                'card_style'        => 'light',
            ],

            // ── STORAGE DEVICES ──────────────────────────────────────────────
            [
                'category'          => 'storage-devices',
                'name'              => 'MonarchiNAS 120TB',
                'short_description' => '120TB enterprise NAS with redundant storage.',
                'description'       => '24-bay NAS system with RAID 6 support, dual 10GbE ports, SSD caching, and an intuitive management dashboard. Ideal for media production and archives.',
                'price'             => 12500.00,
                'stock_quantity'    => 5,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'dark',
            ],
            [
                'category'          => 'storage-devices',
                'name'              => 'MonarchiDrive NVMe 4TB',
                'short_description' => 'High-speed NVMe SSD for server and workstation.',
                'description'       => 'PCIe Gen 4 NVMe SSD delivering up to 7,000 MB/s read speeds. Enterprise endurance rating with 5-year warranty.',
                'price'             => 850.00,
                'stock_quantity'    => 35,
                'is_featured'       => false,
                'badge_text'        => 'New',
                'badge_color'       => 'green',
                'card_style'        => 'light',
            ],

            // ── WORKSTATIONS ─────────────────────────────────────────────────
            [
                'category'          => 'workstations',
                'name'              => 'MonarchiDesk Creator Pro',
                'short_description' => 'High-performance workstation for content and dev.',
                'description'       => 'AMD Ryzen 9 7950X, RTX 4080 GPU, 128GB DDR5, 2TB NVMe SSD. Built for engineers, designers, and AI developers demanding uncompromising performance.',
                'price'             => 14500.00,
                'sale_price'        => 12999.00,
                'stock_quantity'    => 7,
                'is_featured'       => true,
                'badge_text'        => 'Limited Time',
                'badge_color'       => 'orange',
                'card_style'        => 'promo',
            ],
            [
                'category'          => 'workstations',
                'name'              => 'MonarchiDesk Business',
                'short_description' => 'Compact business workstation with silent cooling.',
                'description'       => 'Intel Core i7-13700, 32GB DDR5, 1TB NVMe SSD. Ultra-quiet 30dB operation — perfect for open-plan offices.',
                'price'             => 5800.00,
                'stock_quantity'    => 10,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],

            // ── ACCESSORIES ──────────────────────────────────────────────────
            [
                'category'          => 'accessories',
                'name'              => 'MonarchiUPS 3000VA',
                'short_description' => 'Smart UPS with LCD display and AVR.',
                'description'       => '3000VA/2700W online UPS with automatic voltage regulation, pure sine wave output, and network-manageable SNMP card slot.',
                'price'             => 1200.00,
                'stock_quantity'    => 25,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],
            [
                'category'          => 'accessories',
                'name'              => 'MonarchiCable Cat8 Bulk',
                'short_description' => '305m spool of Cat8 shielded Ethernet cable.',
                'description'       => 'S/FTP Category 8 bulk cable rated for 40Gbps at 2GHz. Suitable for data centre structured cabling up to 30m.',
                'price'             => 680.00,
                'stock_quantity'    => 3,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],

            // ── SOFTWARE LICENSES ────────────────────────────────────────────
            [
                'category'          => 'software-licenses',
                'name'              => 'MonarchiCRM Enterprise License',
                'short_description' => 'Perpetual CRM license for unlimited users.',
                'description'       => 'A one-time perpetual license for MonarchiCRM Enterprise — includes 1-year software updates, priority support, and on-premise deployment rights.',
                'price'             => 3500.00,
                'stock_quantity'    => 999,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],
            [
                'category'          => 'software-licenses',
                'name'              => 'MonarchiSec Endpoint Suite',
                'short_description' => 'AI-powered endpoint security for 50 devices.',
                'description'       => 'Next-gen antivirus, EDR, and zero-trust network access for 50 endpoints. Centralised cloud management console included.',
                'price'             => 1750.00,
                'sale_price'        => 1499.00,
                'stock_quantity'    => 999,
                'is_featured'       => false,
                'badge_text'        => 'Sale',
                'badge_color'       => 'red',
                'card_style'        => 'light',
            ],

            // ── AUDIO / VISUAL ───────────────────────────────────────────────
            [
                'category'          => 'audio-visual',
                'name'              => 'MonarchiConf 4K Room Kit',
                'short_description' => '4K video conferencing system for boardrooms.',
                'description'       => 'All-in-one conferencing kit with 4K camera, 12-mic array speakerphone, and room controller. Plug-and-play with Teams, Zoom, and Meet.',
                'price'             => 4200.00,
                'stock_quantity'    => 9,
                'is_featured'       => false,
                'badge_text'        => 'New',
                'badge_color'       => 'green',
                'card_style'        => 'light',
            ],
            [
                'category'          => 'audio-visual',
                'name'              => 'MonarchiDisplay 55" 4K',
                'short_description' => '55-inch 4K commercial display for digital signage.',
                'description'       => 'Commercial-grade IPS panel with 700 nit brightness, built-in media player, RS-232/LAN control, and 24/7 operation rating.',
                'price'             => 3800.00,
                'stock_quantity'    => 14,
                'is_featured'       => false,
                'badge_text'        => null,
                'card_style'        => 'light',
            ],
        ];

        foreach ($products as $data) {
            $categorySlug = $data['category'];
            if (!isset($categories[$categorySlug])) continue;

            $slug = Str::slug($data['name']);

            Product::firstOrCreate(
                ['slug' => $slug],
                [
                    'category_id'        => $categories[$categorySlug],
                    'name'               => $data['name'],
                    'slug'               => $slug,
                    'sku'                => 'MHQ-' . strtoupper(Str::random(6)),
                    'short_description'  => $data['short_description'],
                    'description'        => $data['description'],
                    'price'              => $data['price'],
                    'sale_price'         => $data['sale_price'] ?? null,
                    'stock_quantity'     => $data['stock_quantity'],
                    'min_stock_threshold'=> 5,
                    'is_featured'        => $data['is_featured'],
                    'is_active'          => true,
                    'badge_text'         => $data['badge_text'] ?? null,
                    'badge_color'        => $data['badge_color'] ?? 'orange',
                    'card_style'         => $data['card_style'] ?? 'light',
                    'image_path'         => null, // Will be uploaded via admin dashboard
                ]
            );
        }
    }
}
