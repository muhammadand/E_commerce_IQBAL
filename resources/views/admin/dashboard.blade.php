@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <h6 class="op-7 mb-2">Bayeng Putra</h6>
    </div>


  
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-primary bubble-shadow-small"
                >
                <i class="fas fa-box-open"></i>

                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Product</p>
                  <h4 class="card-title">{{ $totalProducts }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-info bubble-shadow-small"
                >
                <i class="fas fa-shopping-cart"></i>

                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Orders</p>
                  <h4 class="card-title">{{ $totalOrders }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-success bubble-shadow-small"
                >
                <i class="fas fa-coins"></i>

                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Revenue</p>
                  <small class="card-title">{{ number_format($totalOrder, 0, ',', '.') }}</small>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-secondary bubble-shadow-small"
                >
                <i class="fas fa-users"></i>

                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Users</p>
                  <h4 class="card-title">{{ $totalUsers }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




   
    {{-- row 3 --}}

       


    {{-- row 4 --}}


    <div class="row">
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Top 5 Pelanggan Aktif</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah Order</th>
                                <th>Total Belanja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topCustomers as $cust)
                            <tr>
                                <td>{{ $cust->name }}</td>
                                <td>{{ $cust->total_orders }}</td>
                                <td>Rp{{ number_format($cust->total_spent, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        

        <div class="col-md-7">
          <div class="card card-round">
              <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Transaction History</div>
                      <div class="card-tools">
                          <div class="dropdown">
                              <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-h"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-body p-0">
                  <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-0">
                          <thead class="thead-light">
                              <tr>
                                  <th scope="col">Payment Number</th>
                                  <th scope="col" class="text-end">Date & Time</th>
                                  <th scope="col" class="text-end">Amount</th>
                                  <th scope="col" class="text-end">Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($orders as $order)
                                  <tr>
                                      <th scope="row">
                                          <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                              <i class="fa fa-check"></i>
                                          </button>
                                          Payment from #{{ $order->midtrans_order_id }}
                                      </th>
                                      <td class="text-end">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y, h:ia') }}</td>
                                      <td class="text-end">Rp.{{ number_format($order->total) }}</td>
                                      <td class="text-end">
                                          <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                              {{ ucfirst($order->payment_status) }}
                                          </span>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <!-- Pagination Links -->
                  <div class="d-flex justify-content-center">
                      {{ $orders->links() }}
                  </div>
              </div>
          </div>
      </div>
      

    </div>
{{-- 
    <div class="container mt-5">
        <h2 class="mb-4">👑 Admin Dashboard</h2>
        <div class="alert alert-success">
            Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Admin</strong>.
        </div>
    </div> --}}
@endsection
